<?php
// Website configuration
define('SITE_NAME', 'GameStum');
define('SITE_DESCRIPTION', 'Leading Local App & Game Developer');
define('SITE_URL', 'http://localhost/gamestum');
define('DATA_PATH', __DIR__ . '/../data/');

// Company information
$company_info = [
    'name' => 'GameStum',
    'email' => 'info@devlokal.id',
    'phone' => '+62 21 1234 5678',
    'address' => 'Digital Street No. 123, South Jakarta, Indonesia',
    'working_hours' => 'Monday - Friday: 09:00 - 18:00'
];

// Applications data with external image URLs and video
$applications = [
    [
        'id' => 1,
        'name' => 'Kuliner Nusantara',
        'description' => 'Culinary guide app with local restaurant search and traditional Indonesian recipes features.',
        'tags' => ['Mobile App', 'Culinary', 'Android'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=300&fit=crop'
            ]
        ],
        'video' => [
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/embed/abc123',
            'thumbnail' => 'https://img.youtube.com/vi/abc123/maxresdefault.jpg'
        ],
        'status' => 'Published'
    ],
    [
        'id' => 2,
        'name' => 'Petualangan Naga',
        'description' => 'Adventure game with story based on Indonesian mythology, stunning 3D graphics.',
        'tags' => ['Game', 'Adventure', '3D'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1534423861386-85a16f5d13fd?w=400&h=300&fit=crop'
            ]
        ],
        'video' => [
            'type' => 'youtube', 
            'url' => 'https://www.youtube.com/embed/def456',
            'thumbnail' => 'https://img.youtube.com/vi/def456/maxresdefault.jpg'
        ],
        'status' => 'Published'
    ],
    [
        'id' => 3,
        'name' => 'E-Wisata',
        'description' => 'Tourism ticket and tour booking platform with the best local destination recommendations.',
        'tags' => ['Web App', 'Tourism', 'Booking'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1505765050516-f72dcac9c60e?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1439066615861-d1af74d74000?w=400&h=300&fit=crop'
            ]
        ],
        'video' => [
            'type' => 'external',
            'url' => 'https://example.com/video/demo.mp4'
        ],
        'status' => 'Published'
    ],
    [
        'id' => 4,
        'name' => 'Puzzle Tradisional',
        'description' => 'Educational puzzle game featuring traditional Indonesian games with modern touch.',
        'tags' => ['Game', 'Puzzle', 'Education'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1632501641765-e568d28b0019?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1612036782180-6f4b5a6b6a0a?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1586773860418-d37222d8fce3?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=400&h=300&fit=crop'
            ]
        ],
        // No video for this app
        'status' => 'Published'
    ],
    [
        'id' => 5,
        'name' => 'FinLokal',
        'description' => 'Digital finance app with payment, investment, and loan features for local SMEs.',
        'tags' => ['Mobile App', 'Fintech', 'iOS & Android'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1554224154-260c1b7e0b7a?w=400&h=300&fit=crop'
            ]
        ],
        'video' => [
            'type' => 'youtube',
            'url' => 'https://www.youtube.com/embed/ghi789',
            'thumbnail' => 'https://img.youtube.com/vi/ghi789/maxresdefault.jpg'
        ],
        'status' => 'Published'
    ],
    [
        'id' => 6,
        'name' => 'Kerajaan Nusantara',
        'description' => 'Strategy game themed around ancient Indonesian kingdoms with deep gameplay mechanics.',
        'tags' => ['Game', 'Strategy', 'Multiplayer'],
        'images' => [
            'main' => 'https://images.unsplash.com/photo-1542751110-97427bbecf20?w=800&h=600&fit=crop',
            'thumbnails' => [
                'https://images.unsplash.com/photo-1534423861386-85a16f5d13fd?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1511882150382-421056c89033?w=400&h=300&fit=crop',
                'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=400&h=300&fit=crop'
            ]
        ],
        'video' => [
            'type' => 'external',
            'url' => 'https://example.com/video/game-trailer.mp4'
        ],
        'status' => 'Published'
    ]
];

// Job openings data
$job_openings = [
    [
        'id' => 1,
        'title' => 'Frontend Developer',
        'location' => 'Jakarta (Hybrid)',
        'type' => 'Full-time',
        'experience' => 'Min. 2 years experience',
        'description' => 'We are looking for experienced Frontend Developer with React.js/Vue.js to develop engaging and responsive user interfaces.',
        'status' => 'open'
    ],
    [
        'id' => 2,
        'title' => 'Game Designer',
        'location' => 'Bandung (On-site)',
        'type' => 'Full-time',
        'experience' => 'Min. 3 years experience',
        'description' => 'Join as Game Designer to create immersive gameplay experiences and innovative game mechanics.',
        'status' => 'open'
    ],
    [
        'id' => 3,
        'title' => 'UI/UX Designer',
        'location' => 'Remote',
        'type' => 'Full-time',
        'experience' => 'Min. 2 years experience',
        'description' => 'Looking for talented UI/UX Designer to design intuitive user experiences and engaging interfaces for our apps and games.',
        'status' => 'open'
    ]
];

// HAPUS SEMUA FUNGSI DARI SINI - PINDAHKAN KE functions.php
?>