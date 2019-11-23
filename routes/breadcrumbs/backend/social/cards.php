<?php

Breadcrumbs::for('admin.social.cards.index', function ($trail) {
    $trail->push(__('labels.backend.social.cards.management'), route('admin.social.cards.index'));
});

Breadcrumbs::for('admin.social.cards.deactivated', function ($trail) {
    $trail->parent('admin.social.cards.index');
    $trail->push(__('menus.backend.social.cards.deactivated'), route('admin.social.cards.deactivated'));
});

Breadcrumbs::for('admin.social.cards.deleted', function ($trail) {
    $trail->parent('admin.social.cards.index');
    $trail->push(__('menus.backend.social.cards.deleted'), route('admin.social.cards.deleted'));
});

Breadcrumbs::for('admin.social.cards.show', function ($trail, $id) {
    $trail->parent('admin.social.cards.index');
    $trail->push(__('menus.backend.social.cards.view'), route('admin.social.cards.show', $id));
});
