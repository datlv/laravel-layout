<?php
return [
    'widget_types'                 => 'Widgets hiện có',
    'widget_types_description'     => 'Sử dụng Widget bằng cách Kéo/Thả nó vào Sidebar và thiết lập cấu hình...',
    'inactive_widgets'             => 'Widgets không sử dụng',
    'inactive_widgets_description' => 'Kéo/Thả widget vào đây để tạm thời xóa khỏi sidebar nhưng vẫn giữa các thiết lập',
    'delete_widget'                => 'Xóa Widget?',
    'delete_widget_confirm'        => 'Bạn có chắc chắn muốn xóa Widget này?<br>Bạn sẻ không thể khôi phục',
    'select_route'                 => 'Chọn route...',

    'sidebars' => [
        'default' => [
            'title'       => 'Sidebar Mặc định',
            'description' => 'Hiển thị các widget ở khu vực Sidebar tất cả các trang',
        ],
        'bottom'  => [
            'title'       => 'Bottom Sidebar',
            'description' => 'Hiển thị các widget ở khu vực dưới tất cả các trang',
        ],
        'footer'  => [
            'title'       => 'Footer Sidebar',
            'description' => 'Hiển thị các widget ở khu vực footer tất cả các trang',
        ],
    ],

    'widgetTypes' => [
        'text'              => [
            'title'       => 'Text',
            'description' => 'Hiển thị dữ liệu text HTML',
            // data
            'content'     => 'Nội dung',
        ],
        'text_icon'         => [
            'title'       => 'Text - Icon',
            'description' => 'Hiển thị dữ liệu text và icon',
            // data
            'icon'        => 'Icon',
            'text'        => 'Nội dung',
        ],
        'button'            => [
            'title'       => 'Button',
            'description' => 'Hiển thị Button có icon và label',
            // data
            'url'         => 'Link',
            'icon'        => 'Icon',
            'label'       => 'Nhãn',
            'btn_type'    => 'Loại Button',
            'btn_size'    => 'Kích thước',
        ],
        'social_button'     => [
            'title'       => 'Social Buttons',
            'description' => 'Hiển thị các liên kết mạng xã hội',
            // data
            'facebook'    => 'Facebook Fanpage',
            'twitter'     => 'Twitter',
            'google'      => 'Google+',
            'youtube'     => 'Youtube Channel',
            'btn_type'    => 'Loại Button',
            'btn_size'    => 'Kích thước',
        ],
        'image'             => [
            'title'       => 'Hình ảnh',
            'description' => 'Hiển thị hình ảnh',
            // data
            'image_id'    => 'ID file hình ảnh',
        ],
        'customer_feedback' => [
            'title'       => 'Customer Feedback',
            'description' => 'Hiển thị phản hồi của khách hàng',
            // data
            'content'     => 'Nội dung',
            'image_id'    => 'ID file hình ảnh',
            'name'        => 'Tên khách hàng',
            'office'      => 'Chức vụ',
        ],
        'search'            => [
            'title'        => 'Tìm kiếm',
            'description'  => 'Hiển thị ô tìm kiếm',
            // data
            'route_result' => 'Route trang kết quả',
        ],
    ],
];