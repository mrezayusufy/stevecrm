<?php

namespace Webkul\Automation\Repositories;

use Webkul\Core\Eloquent\Repository;

class AutomationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Automation\Contracts\Automation';
    }


    /**
     * @param  string  $dateRange
     * @return mixed
     */
    public function getAutomations($dateRange)
    {
        return $this->select(
            'automations.id',
            'automations.created_at',
            'automations.title',
            'automations.schedule_from as start',
            'automations.schedule_to as end',
            'users.name as user_name',
        )
            ->addSelect(\DB::raw('IF(automations.is_done, "done", "") as class'))
            ->leftJoin('users', 'automations.user_id', '=', 'users.id')
            ->whereIn('type', ['call', 'meeting', 'lunch'])
            ->whereBetween('automations.schedule_from', $dateRange)
            ->where(function ($query) {
                $currentUser = auth()->guard('user')->user();

                if ($currentUser->view_permission != 'global') {
                    if ($currentUser->view_permission == 'group') {
                        $userIds = app(UserRepository::class)->getCurrentUserGroupsUserIds();

                        $query->whereIn('automations.user_id', $userIds);
                    } else {
                        $query->where('automations.user_id', $currentUser->id);
                    }
                }
            })
            ->distinct()
            ->get();
    }

    /**
     * @param  string  $startFrom
     * @param  string  $endFrom
     * @param  array  $participants
     * @param  integer  $id
     * @return boolean
     */
    public function isDurationOverlapping($startFrom, $endFrom, $participants = [], $id)
    {
        $queryBuilder = $this->model
            ->where(function ($query) use ($startFrom, $endFrom) {
                $query->where([
                    ['automations.schedule_from', '<=', $startFrom],
                    ['automations.schedule_to', '>=', $startFrom],
                ])->orWhere([
                    ['automations.schedule_from', '>=', $startFrom],
                    ['automations.schedule_from', '<=', $endFrom],
                ]);
            })
            ->where(function ($query) use ($participants) {
                if (is_null($participants)) {
                    return;
                }

                if (isset($participants['users'])) {
                    $query->orWhereIn('automation_participants.user_id', $participants['users']);
                }

            })
            ->groupBy('automations.id');

        if (!is_null($id)) {
            $queryBuilder->where('automations.id', '!=', $id);
        }

        return $queryBuilder->count() ? true : false;
    }
}
