<?php

Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->push(__('labels.backend.news.management'), route('admin.news.index'));
});

Breadcrumbs::for('admin.news.deactivated', function ($trail) {
    $trail->parent('admin.news.index');
    $trail->push(__('menus.backend.news.deactivated'), route('admin.news.deactivated'));
});

Breadcrumbs::for('admin.news.deleted', function ($trail) {
    $trail->parent('admin.news.index');
    $trail->push(__('menus.backend.news.deleted'), route('admin.news.deleted'));
});

Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->parent('admin.news.index');
    $trail->push(__('labels.backend.news.create'), route('admin.news.create'));
});

Breadcrumbs::for('admin.news.show', function ($trail, $id) {
    $trail->parent('admin.news.index');
    $trail->push(__('menus.backend.news.view'), route('admin.news.show', $id));
});

Breadcrumbs::for('admin.news.edit', function ($trail, $id) {
    $trail->parent('admin.news.index');
    $trail->push(__('menus.backend.news.edit'), route('admin.news.edit', $id));
});
