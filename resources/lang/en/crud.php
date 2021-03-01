<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'podcasts' => [
        'name' => 'Podcasts',
        'index_title' => 'Podcasts List',
        'create_title' => 'Create Podcast',
        'edit_title' => 'Edit Podcast',
        'show_title' => 'Show Podcast',
        'inputs' => [
            'album_id' => 'Album Id',
            'title' => 'Title',
            'audio_url' => 'Audio Url',
            'size' => 'Size',
        ],
    ],

    'albums' => [
        'name' => 'Albums',
        'index_title' => 'Albums List',
        'create_title' => 'Create Album',
        'edit_title' => 'Edit Album',
        'show_title' => 'Show Album',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'comments' => [
        'name' => 'Comments',
        'index_title' => 'Comments List',
        'create_title' => 'Create Comment',
        'edit_title' => 'Edit Comment',
        'show_title' => 'Show Comment',
        'inputs' => [
            'podcast_id' => 'Podcast',
            'guest_id' => 'Guest',
        ],
    ],

    'likes' => [
        'name' => 'Likes',
        'index_title' => 'Likes List',
        'create_title' => 'Create Like',
        'edit_title' => 'Edit Like',
        'show_title' => 'Show Like',
        'inputs' => [
            'podcast_id' => 'Podcast',
            'guest_id' => 'Guest',
        ],
    ],

    'guests' => [
        'name' => 'Guests',
        'index_title' => 'Guests List',
        'create_title' => 'Create Guest',
        'edit_title' => 'Edit Guest',
        'show_title' => 'Show Guest',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],
];
