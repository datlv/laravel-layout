<?php

return [
    /**
     * Khai báo middleware cho Controller quản lý
     */
    'middleware' => ['web', 'role:sys.admin'],

    // Định nghĩa menus quản lý sidebar/widget
    'menus' => [
        'backend.sidebar.appearance.widget_homepage' => [
            'priority' => 1,
            'url' => 'route:backend.widget.index|group:homepage',
            'label' => 'trans:layout::group.homepage',
            'icon' => 'fa-home',
            'active' => 'backend/widget/index/homepage*',
        ],
        'backend.sidebar.appearance.widget_all' => [
            'priority' => 2,
            'url' => 'route:backend.widget.index|group:all',
            'label' => 'trans:layout::group.all',
            'icon' => 'fa-puzzle-piece',
            'active' => 'backend/widget/index/all*',
        ],
    ],
    'customSidebars' => [],
    'sidebarGroups' => [
        'homepage' => [
            'title' => 'trans::layout::group.homepage',
            'description' => 'trans::layout::group.homepage_description',
        ],
        'all' => [
            'title' => 'trans::layout::group.all',
            'description' => 'trans::layout::group.all_description',
        ],
    ],
    'sidebars' => [
        'default' => [
            'title' => 'trans::layout::common.sidebars.default.title',
            'description' => 'trans::layout::common.sidebars.default.description',
            'group' => 'all',
        ],
        'bottom' => [
            'title' => 'trans::layout::common.sidebars.bottom.title',
            'description' => 'trans::layout::common.sidebars.bottom.description',
            'group' => 'all',
        ],
        'footer' => [
            'title' => 'trans::layout::common.sidebars.footer.title',
            'description' => 'trans::layout::common.sidebars.footer.description',
            'group' => 'all',
        ],
    ],
    'widgetTypes' => [
        'text' => [
            'title' => 'trans::layout::common.widgetTypes.text.title',
            'description' => 'trans::layout::common.widgetTypes.text.description',
            'icon' => 'file-text-o',
            'class' => \Datlv\Layout\WidgetTypes\TextWidget::class,
        ],
        'text_icon' => [
            'title' => 'trans::layout::common.widgetTypes.text_icon.title',
            'description' => 'trans::layout::common.widgetTypes.text_icon.description',
            'icon' => 'list-ul',
            'class' => \Datlv\Layout\WidgetTypes\TextIconWidget::class,
        ],
        'button' => [
            'title' => 'trans::layout::common.widgetTypes.button.title',
            'description' => 'trans::layout::common.widgetTypes.button.description',
            'icon' => 'hand-pointer-o',
            'class' => \Datlv\Layout\WidgetTypes\ButtonWidget::class,
        ],
        'social_button' => [
            'title' => 'trans::layout::common.widgetTypes.social_button.title',
            'description' => 'trans::layout::common.widgetTypes.social_button.description',
            'icon' => 'facebook-square',
            'class' => \Datlv\Layout\WidgetTypes\SocialButtonWidget::class,
        ],
        'image' => [
            'title' => 'trans::layout::common.widgetTypes.image.title',
            'description' => 'trans::layout::common.widgetTypes.image.description',
            'icon' => 'image',
            'class' => \Datlv\Layout\WidgetTypes\ImageWidget::class,
        ],
        'customer_feedback' => [
            'title' => 'trans::layout::common.widgetTypes.customer_feedback.title',
            'description' => 'trans::layout::common.widgetTypes.customer_feedback.description',
            'icon' => 'user-circle-o',
            'class' => \Datlv\Layout\WidgetTypes\CustomerFeedbackWidget::class,
        ],
        'search' => [
            'title' => 'trans::layout::common.widgetTypes.search.title',
            'description' => 'trans::layout::common.widgetTypes.search.description',
            'icon' => 'search',
            'class' => \Datlv\Layout\WidgetTypes\SearchWidget::class,
        ],
    ],
    'disableTypes' => [],
];
