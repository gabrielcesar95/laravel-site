<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = [
            'column' => 'created_at',
            'direction' => 'desc'
        ];
        $data = Activity::orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'));

        return view('admin.logs.index', compact('data', 'order'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Activity::findOrFail($id);

        switch ($log->description) {
            case 'created':
                $log->badge = [
                    'icon' => 'plus-circle',
                    'class' => 'success',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'updated':
                $log->badge = [
                    'icon' => 'pencil',
                    'class' => 'primary',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'deleted':
                $log->badge = [
                    'icon' => 'delete',
                    'class' => 'danger',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'login':
                $log->badge = [
                    'icon' => 'login',
                    'class' => 'secondary',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'logout':
                $log->badge = [
                    'icon' => 'power',
                    'class' => 'secondary',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'login_failed':
                $log->badge = [
                    'icon' => 'message-alert',
                    'class' => 'warning',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;
            case 'password_reset':
                $log->badge = [
                    'icon' => 'lock-reset',
                    'class' => 'info',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
                break;

            default:
                $log->badge = [
                    'icon' => 'circle-outline',
                    'class' => 'light',
                    'description' => __("logs.descriptions.{$log->description}")
                ];
        }

        return view('admin.logs.show', compact('log'));
    }

    public function filter(Request $request)
    {
        $params = Arr::except(array_filter($request->all(), function ($p) {
            return $p !== null;
        }), ['_order', '_order_direction', '_page']);

        $order = [
            'column' => $request->get('_order') ?? 'id',
            'direction' => $request->get('_order_direction') ?? 'asc'
        ];

        $page = $request->get('_page') ?? 1;

        if ($params) {
            $data = Activity::whereHasMorph('causer', ['App\Models\User'], function ($query) use ($params, $order) {
                foreach ($params as $param => $props) {
                    if (is_array($props)) {
                        switch ($props['operator']) {
                            case 'LIKE':
                                $query->where($param, 'LIKE', "%{$props['value']}%");
                                break;

                            default:
                                $query->where($param, $props['operator'] ?? '=', $props['value']);
                        }
                    } else {
                        $query->where($param, $props);
                    }
                }
            })->orderBy($order['column'], $order['direction'])->paginate(env('APP_RESULTS_PER_PAGE'), ['*'], 'page', $page);
        } else {
            $data = Activity::orderByRaw("{$order['column']} {$order['direction']}")->paginate(env('APP_RESULTS_PER_PAGE'));
        }

        return view('admin.logs.index_list', compact('data', 'order'));
    }
}
