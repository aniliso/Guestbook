<?php

namespace Modules\Guestbook\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('guestbook::guestbook.title.guestbook'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->route('admin.guestbook.comment.index');
                $item->authorize(
                    $this->auth->hasAccess('guestbook.comments.index')
                );
//                $item->item(trans('guestbook::comments.title.comments'), function (Item $item) {
//                    $item->icon('fa fa-copy');
//                    $item->weight(0);
//                    $item->append('admin.guestbook.comment.create');
//                    $item->route('admin.guestbook.comment.index');
//                    $item->authorize(
//                        $this->auth->hasAccess('guestbook.comments.index')
//                    );
//                });
// append

            });
        });

        return $menu;
    }
}
