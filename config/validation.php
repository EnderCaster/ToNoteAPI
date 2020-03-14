<?php
return [
    'users' => [
        'username.unique' => '用户名已存在',
        'username.required' => '请填写用户名',
        'username.alpha_dash' => '用户名仅允许填写英文字母及横杠、下划线',
        'username.between' => '用户名长度在:min至:max之间',
        'password.required' => '请输入密码',
        'password.between' => '密码的长度应该在:min至:max之间',
        'password.confirmed' => '两次输入的密码不符，请重试',
        'password_confirmation.required' => '请确认密码',
    ],
    'notebooks' => [
        'name.required' => '请输入笔记本名称'
    ],
    'partitions' => [
        'parent.required' => '请输入笔记本ID',
        'name.required' => '请输入分区名称',
    ],
    'pages' => [
        'parent.required' => '请输入分区ID',
        'title.required' => '请输入标题',
        'content.required' => '请输入内容',
    ]
];
