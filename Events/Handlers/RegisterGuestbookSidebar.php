<?php

namespace Modules\Guestbook\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterGuestbookSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('guestbook::guestbook.title.guestbook'), function (Item $item) {
                $item->icon('fa fa-comment');
                $item->weight(10);
                $item->route('admin.guestbook.comment.index');
                $item->authorize(
                    $this->auth->hasAccess('guestbook.comments.index')
                );
            });
        });

        return $menu;
    }
}
