<?php
return [
    // 用于记录当天记录发生过被点赞的文章的ID set
    'day_give_articles' => 'day_give_articles',

    // 当天给文章点赞用户  晚上同步到数据库后删除 hash
    'day_give_articles_users' => 'day_give_change_articles',

    // 文章的全部点赞用户 sorted set
    'give_articles_users' => 'give_articles_users'
];
