<?php namespace Modules\Contact\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Core\Composers\BaseSidebarViewComposer;


class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        if (! $view->sidebar instanceof SidebarManager) {
            return;
        }

        $view->sidebar->group(trans('core::sidebar.content'), function (SidebarGroup $group) {
            $group->addItem(trans('contact::contacts.title.contacts'), function (SidebarItem $item) {
                $item->authorize(
                    $this->auth->hasAccess('contact.contacts.index')
                );
                $item->icon = 'fa fa-envelope-o';
                $item->weight = 10;
                $item->route('admin.contact.contact.index');
                $item->authorize(
                    $this->auth->hasAccess('contact.contacts.index')
                );
            });
        });
    }
}
