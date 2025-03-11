<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Social Media',
            'Adult & Pornographic Content',
            'E-commerce & Online Shopping',
            'Education & Learning',
            'Government & Politics',
            'Entertainment',
            'News & Media',
            'Personal Blogs & Vlogs',
            'Technology & Software',
            'Health & Wellness',
            'Business & Corporate',
            'Finance & Banking',
            'Gaming',
            'Gambling & Betting',
            'Travel & Tourism',
            'Real Estate & Property',
            'Food & Beverages',
            'Automotive & Vehicles',
            'Science & Research',
            'Law & Legal Services',
            'Religion & Spirituality',
            'Sports & Athletics',
            'Cryptocurrency & Blockchain',
            'Online Forums & Communities',
            'Job Portals & Career Development',
            'Cybersecurity & Privacy',
            'Web Hosting & Domain Services',
            'Streaming Services',
            'Lifestyle & Fashion',
            'DIY & Home Improvement',
            'Non-Profit & Charity',
            'Dating & Relationships',
            'Books & Literature',
            'Art & Design',
            'Photography & Visual Arts',
            'Parenting & Childcare',
            'Animals & Pets',
            'Weather & Environment',
            'Military & Defense',
            'Artificial Intelligence',
            'Freelancing & Remote Work',
            'Advertising & Marketing',
            'Self-Improvement & Motivation',
            'Memes & Humor',
            'Data Science & Analytics',
            'Hobbies & Collectibles',
            'Space & Astronomy',
            'Transportation & Logistics',
            'Event Planning & Ticketing',
            'Energy & Utilities',
            'Home Decor & Interior Design',
            'Watches & Accessories',
            'Surveys & Polling',
            'Fitness & Exercise',
            'Alternative Medicine & Therapy',
            'Spiritual & Esoteric Practices',
            'Mental Health & Counseling',
            'Genealogy & Family History',
            'Philosophy & Thought',
            'Online Courses & Certifications',
            'Cybercrime & Ethical Hacking',
            'Consumer Electronics',
            'Augmented & Virtual Reality',
            'Industrial & Manufacturing',
            'Online Auctions & Bidding',
            'Academic Research & Papers',
            'Aviation & Airlines',
            'Luxury & High-End Products',
            'Military Technology & Defense',
            'Conspiracy Theories',
            'Toys & Games',
            'Astrology & Horoscope',
            'Board Games & Card Games',
            'Coding & Programming',
            'Children’s Education & Activities',
            'Psychology & Behavioral Science',
            'Spiritual Healing & Meditation',
            'Ethics & Morality',
            'Weapons & Firearms',
            'Hiking & Outdoor Activities',
            'Scams & Fraud Prevention',
            'Stock Market & Investing',
            'Insurance & Risk Management',
            'Translation & Language Services',
            'Classifieds & Local Listings',
            'Product Reviews & Unboxings',
            'Customer Service & Complaints',
            'Mathematics & Logic',
            'Artificial Life & Robotics',
            'Music Streaming & Downloads',
            'Digital & Traditional Art',
            'Paranormal & UFOs',
            'Weather Forecasting',
            'Weddings & Marriage Planning',
            'Search Engines & Web Directories',
            'Public Transport & Metro Services',
            'DIY Electronics & Engineering',
            'Home Security & Smart Devices',
            'Gardening & Landscaping',
            'Podcasting & Internet Radio',
            'Medical Equipment & Devices',
            'Volunteer & Community Services',
            'Luxury Travel & Lifestyle',
            'Psychic & Tarot Reading',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
