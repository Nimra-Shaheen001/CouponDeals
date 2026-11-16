
<?php
/*
|--------------------------------------------------------------------------
| CouponDeals category data
|--------------------------------------------------------------------------
| Each category uses:
| name, icon, description, subcategories, stores, image
|
| Demo records. Replace with database records later.
*/

$siteCategories = [

    "fashion" => [
        "name" => "Fashion & Clothing",
        "icon" => "bi-bag-heart",
        "description" => "Discover stylish clothing, trending fashion, accessories and popular brands for every occasion.",
        "subcategories" => [
            "Men's Fashion", "Women's Fashion", "Dresses",
            "Jeans", "Jackets", "Casual Wear",
            "Designer Fashion", "Accessories"
        ],
        "stores" => ["Nike", "Adidas", "Zara", "ASOS", "H&M", "SHEIN"],
        "image" => "https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1200&auto=format&fit=crop&q=85"
    ],

    "electronics" => [
        "name" => "Electronics & Gadgets",
        "icon" => "bi-laptop",
        "description" => "Explore smartphones, computers, gaming devices and everyday electronics.",
        "subcategories" => [
            "Smartphones", "Laptops", "Computers",
            "Smart Watches", "Headphones", "Cameras",
            "Gaming Devices", "Accessories"
        ],
        "stores" => ["Amazon", "Apple", "Samsung", "Best Buy", "Dell", "Sony"],
        "image" => "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200&auto=format&fit=crop&q=85"
    ],

    "beauty" => [
        "name" => "Beauty & Personal Care",
        "icon" => "bi-stars",
        "description" => "Explore skincare, makeup, fragrances and personal care from popular beauty brands.",
        "subcategories" => [
            "Skincare", "Makeup", "Perfumes",
            "Hair Care", "Bath & Body", "Beauty Tools",
            "Fragrances", "Personal Care"
        ],
        "stores" => ["Sephora", "Ulta Beauty", "The Body Shop", "L'Oreal", "Aveda"],
        "image" => "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=1200&auto=format&fit=crop&q=85"
    ],

    "home" => [
        "name" => "Home & Garden",
        "icon" => "bi-house-heart",
        "description" => "Refresh your living space with furniture, home décor and garden essentials.",
        "subcategories" => [
            "Furniture", "Home Decor", "Lighting",
            "Bedding", "Kitchen", "Garden",
            "Storage", "Home Improvement"
        ],
        "stores" => ["IKEA", "Wayfair", "Walmart", "Target", "Home Depot"],
        "image" => "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1200&auto=format&fit=crop&q=85"
    ],

    "footwear" => [
        "name" => "Shoes & Footwear",
        "icon" => "bi-handbag",
        "description" => "Find running shoes, sneakers, formal footwear and everyday comfort.",
        "subcategories" => [
            "Sneakers", "Running Shoes", "Casual Shoes",
            "Formal Shoes", "Boots", "Sandals",
            "Sports Shoes", "Kids Shoes"
        ],
        "stores" => ["Nike", "Adidas", "Puma", "New Balance", "Skechers", "Vans"],
        "image" => "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200&auto=format&fit=crop&q=85"
    ],

    "health" => [
        "name" => "Health & Wellness",
        "icon" => "bi-heart-pulse",
        "description" => "Discover wellness, personal care, fitness and healthy-living products.",
        "subcategories" => [
            "Wellness", "Personal Care", "Fitness",
            "Nutrition", "Vitamins", "Health Devices",
            "Self Care", "Recovery"
        ],
        "stores" => ["iHerb", "Myprotein", "Walgreens", "Fitbit", "Garmin"],
        "image" => "https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=1200&auto=format&fit=crop&q=85"
    ],

    "travel" => [
        "name" => "Travel & Hotels",
        "icon" => "bi-airplane",
        "description" => "Discover hotels, flights, holiday stays and memorable travel experiences.",
        "subcategories" => [
            "Flights", "Hotels", "Holiday Packages",
            "Car Rental", "Experiences", "Resorts",
            "Travel Accessories", "Cruises"
        ],
        "stores" => ["Booking.com", "Expedia", "Airbnb", "Klook", "Hotels.com"],
        "image" => "https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&auto=format&fit=crop&q=85"
    ],

    "sports" => [
        "name" => "Sports & Outdoors",
        "icon" => "bi-trophy",
        "description" => "Shop sportswear, fitness equipment and outdoor essentials.",
        "subcategories" => [
            "Sportswear", "Running", "Fitness Equipment",
            "Outdoor Gear", "Camping", "Cycling",
            "Training", "Team Sports"
        ],
        "stores" => ["Nike", "Adidas", "Puma", "Gymshark", "Under Armour"],
        "image" => "https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=1200&auto=format&fit=crop&q=85"
    ],

    "food" => [
        "name" => "Food & Restaurants",
        "icon" => "bi-cup-hot",
        "description" => "Explore food delivery, restaurants, groceries and everyday dining.",
        "subcategories" => [
            "Food Delivery", "Restaurants", "Fast Food",
            "Groceries", "Coffee", "Meal Kits",
            "Snacks", "Beverages"
        ],
        "stores" => ["DoorDash", "Uber Eats", "Domino's", "Instacart", "Pizza Hut"],
        "image" => "https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&auto=format&fit=crop&q=85"
    ],

    "baby" => [
        "name" => "Baby & Kids",
        "icon" => "bi-balloon-heart",
        "description" => "Discover clothing, toys, nursery supplies and essentials for children.",
        "subcategories" => [
            "Baby Clothing", "Kids Fashion", "Toys",
            "Nursery", "Baby Care", "Strollers",
            "School Essentials", "Learning Toys"
        ],
        "stores" => ["LEGO", "Walmart", "Target", "Amazon"],
        "image" => "https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=1200&auto=format&fit=crop&q=85"
    ],

    "jewelry" => [
        "name" => "Jewelry & Watches",
        "icon" => "bi-gem",
        "description" => "Browse jewelry collections, stylish watches and gift accessories.",
        "subcategories" => [
            "Rings", "Necklaces", "Watches",
            "Bracelets", "Earrings", "Luxury Jewelry",
            "Fashion Jewelry", "Gifts"
        ],
        "stores" => ["Pandora", "Fossil", "Swarovski", "Kate Spade"],
        "image" => "https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=1200&auto=format&fit=crop&q=85"
    ],

    "automotive" => [
        "name" => "Automotive",
        "icon" => "bi-car-front",
        "description" => "Explore vehicle accessories, car-care essentials and useful automotive products.",
        "subcategories" => [
            "Car Accessories", "Car Care", "Tools",
            "Vehicle Electronics", "Tyres", "Parts",
            "Interior Accessories", "Maintenance"
        ],
        "stores" => ["Amazon", "Walmart", "Best Buy", "eBay"],
        "image" => "https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&auto=format&fit=crop&q=85"
    ],

    "education" => [
        "name" => "Books & Education",
        "icon" => "bi-book",
        "description" => "Discover books, learning resources, online courses and educational supplies.",
        "subcategories" => [
            "Books", "Online Courses", "Education",
            "Stationery", "Study Tools", "Textbooks",
            "Learning Software", "Skill Development"
        ],
        "stores" => ["Amazon", "Udemy", "Canva", "LEGO"],
        "image" => "https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=1200&auto=format&fit=crop&q=85"
    ],

    "pets" => [
        "name" => "Pet Supplies",
        "icon" => "bi-heart",
        "description" => "Find pet food, toys, grooming supplies and essentials for your pets.",
        "subcategories" => [
            "Dog Care", "Cat Care", "Pet Food",
            "Pet Toys", "Grooming", "Pet Bedding",
            "Accessories", "Pet Health"
        ],
        "stores" => ["Chewy", "Petco", "Walmart", "Amazon"],
        "image" => "https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=1200&auto=format&fit=crop&q=85"
    ],

    "software" => [
        "name" => "Software & Apps",
        "icon" => "bi-code-square",
        "description" => "Explore useful software, creative applications and digital tools.",
        "subcategories" => [
            "Productivity", "Design Software", "Security",
            "Business Apps", "Cloud Tools", "Creative Apps",
            "Utilities", "Subscriptions"
        ],
        "stores" => ["Microsoft", "Canva", "Adobe", "Kaspersky", "Wix"],
        "image" => "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200&auto=format&fit=crop&q=85"
    ],

    "hosting" => [
        "name" => "Web Hosting & Domains",
        "icon" => "bi-globe",
        "description" => "Discover hosting services, domains and tools for building websites.",
        "subcategories" => [
            "Web Hosting", "Domain Names", "VPS",
            "Cloud Hosting", "Website Builders", "SSL",
            "Email Hosting", "Managed Hosting"
        ],
        "stores" => ["GoDaddy", "Wix", "Hostinger", "Namecheap"],
        "image" => "https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=1200&auto=format&fit=crop&q=85"
    ],

    "gaming" => [
        "name" => "Gaming & Entertainment",
        "icon" => "bi-controller",
        "description" => "Explore video games, consoles, subscriptions and entertainment brands.",
        "subcategories" => [
            "Video Games", "Consoles", "Game Accessories",
            "Digital Games", "Streaming", "PC Gaming",
            "Subscriptions", "Entertainment"
        ],
        "stores" => ["PlayStation", "Xbox", "Nintendo", "Epic Games", "Steam"],
        "image" => "https://images.unsplash.com/photo-1535223289827-42f1e9919769?w=1200&auto=format&fit=crop&q=85"
    ],

    "gifts" => [
        "name" => "Gifts & Flowers",
        "icon" => "bi-gift",
        "description" => "Discover thoughtful gifts, flowers and personalized products.",
        "subcategories" => [
            "Flowers", "Personalized Gifts", "Gift Baskets",
            "Birthday Gifts", "Anniversary Gifts", "Cards",
            "Gift Ideas", "Celebrations"
        ],
        "stores" => ["Etsy", "1-800-Flowers", "Zazzle", "Amazon"],
        "image" => "https://images.unsplash.com/photo-1513201099705-a9746e1e201f?w=1200&auto=format&fit=crop&q=85"
    ],

    "office" => [
        "name" => "Office Supplies",
        "icon" => "bi-briefcase",
        "description" => "Find office furniture, stationery, printers and workplace essentials.",
        "subcategories" => [
            "Stationery", "Office Furniture", "Printers",
            "Paper", "Desk Accessories", "Storage",
            "Office Technology", "Work Essentials"
        ],
        "stores" => ["Staples", "Office Depot", "HP", "Amazon"],
        "image" => "https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=1200&auto=format&fit=crop&q=85"
    ],

    "furniture" => [
        "name" => "Furniture & Decor",
        "icon" => "bi-lamp",
        "description" => "Shop home furniture, interior decor and comfortable living essentials.",
        "subcategories" => [
            "Sofas", "Beds", "Tables",
            "Chairs", "Office Furniture", "Wall Decor",
            "Lighting", "Storage"
        ],
        "stores" => ["IKEA", "Wayfair", "West Elm", "Walmart"],
        "image" => "https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1200&auto=format&fit=crop&q=85"
    ],

    "mobile-accessories" => [
        "name" => "Mobile Accessories",
        "icon" => "bi-phone",
        "description" => "Discover phone cases, chargers, power banks and mobile accessories.",
        "subcategories" => [
            "Phone Cases", "Chargers", "Power Banks",
            "Earbuds", "Screen Protectors", "Cables",
            "Phone Stands", "Wireless Chargers"
        ],
        "stores" => ["Anker", "Apple", "Samsung", "Amazon", "Best Buy"],
        "image" => "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=1200&auto=format&fit=crop&q=85"
    ],

    "groceries" => [
        "name" => "Groceries & Essentials",
        "icon" => "bi-basket",
        "description" => "Browse grocery delivery, household supplies and everyday essentials.",
        "subcategories" => [
            "Fresh Food", "Beverages", "Pantry",
            "Household", "Cleaning", "Personal Care",
            "Snacks", "Grocery Delivery"
        ],
        "stores" => ["Walmart", "Instacart", "Target", "Amazon"],
        "image" => "https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&auto=format&fit=crop&q=85"
    ]

];
