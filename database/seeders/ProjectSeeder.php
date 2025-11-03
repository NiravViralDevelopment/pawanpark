<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Grand Villa Estate',
                'description' => "Experience the epitome of luxury living in this magnificent estate. This stunning property features breathtaking ocean views, state-of-the-art amenities, and impeccable design throughout. \n\nThe main residence spans over 8,000 square feet and includes a gourmet chef's kitchen, formal dining room, home theater, wine cellar, and a master suite with private terrace. \n\nThe expansive grounds feature infinity pools, outdoor entertainment areas, tennis courts, and lush tropical landscaping. Perfect for those seeking the ultimate in sophisticated coastal living.",
                'location' => 'Beverly Hills, California',
                'is_featured' => true,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Swimming Pool', 'Gym', 'Garden', 'Parking', 'Security', 'CCTV', 'Clubhouse'],
                'bedrooms' => 6,
                'bathrooms' => 8,
                'sqft' => 8500.00,
                'year_built' => 2022,
                'property_type' => 'Villa',
                'images' => [
                    'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800',
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Oceanview Paradise',
                'description' => "Discover unparalleled luxury in this breathtaking oceanfront masterpiece. Situated on a pristine stretch of coastline, this architectural marvel seamlessly blends indoor and outdoor living spaces. \n\nFloor-to-ceiling windows frame panoramic ocean views, while the open-concept design creates an inviting atmosphere for entertaining. The property includes a private beach access, infinity pool, spa, and outdoor kitchen. \n\nEvery detail has been carefully curated to provide the ultimate coastal living experience.",
                'location' => 'Malibu, California',
                'is_featured' => true,
                'is_completed' => false,
                'is_ongoing' => true,
                'features_amenities' => ['Swimming Pool', 'Garden', 'Parking', 'Security', 'Elevator', 'Balcony', 'Terrace'],
                'bedrooms' => 5,
                'bathrooms' => 6,
                'sqft' => 7200.00,
                'year_built' => 2023,
                'property_type' => 'Villa',
                'images' => [
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Modern Luxury Penthouse',
                'description' => "Soar above the city in this spectacular penthouse offering 360-degree views of the skyline. This contemporary masterpiece features cutting-edge design, smart home technology, and luxury finishes throughout. \n\nThe open floor plan maximizes natural light and showcases the stunning city views. Premium amenities include a private rooftop terrace, wine room, media room, and spa-like bathrooms. \n\nBuilding amenities include 24-hour concierge, fitness center, and valet parking.",
                'location' => 'Downtown Miami, Florida',
                'is_featured' => false,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Gym', 'Parking', 'Security', 'Elevator', 'Balcony', 'CCTV', 'Power Backup'],
                'bedrooms' => 4,
                'bathrooms' => 5,
                'sqft' => 5800.00,
                'year_built' => 2021,
                'property_type' => 'Penthouse',
                'images' => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                    'https://images.unsplash.com/photo-1600607687644-c7171b42498b?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Lakeside Mansion',
                'description' => "Nestled on the shores of a pristine private lake, this magnificent estate offers tranquility and elegance. The property features custom craftsmanship, soaring ceilings, and walls of windows overlooking the water. \n\nAmenities include a boat dock, outdoor pavilion, infinity pool, and beautifully landscaped gardens. The main house includes a gourmet kitchen, library, home office, and luxurious master suite with lakefront balcony. \n\nAdditional structures include a guest house and four-car garage.",
                'location' => 'Lake Tahoe, Nevada',
                'is_featured' => true,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Swimming Pool', 'Gym', 'Garden', 'Parking', 'Security', 'Balcony', 'Terrace', 'Clubhouse'],
                'bedrooms' => 7,
                'bathrooms' => 9,
                'sqft' => 9500.00,
                'year_built' => 2020,
                'property_type' => 'Mansion',
                'images' => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800',
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800',
                    'https://images.unsplash.com/photo-1600047509782-20d39509f26d?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Hillside Contemporary Estate',
                'description' => "Perched atop a private hillside, this contemporary estate offers breathtaking valley views and complete privacy. The property showcases clean lines, floor-to-ceiling glass, and seamless indoor-outdoor flow. \n\nThe main level features an open-concept living space with gourmet kitchen, formal dining, and expansive decks. The lower level includes a home theater, wine cellar, and guest suites. \n\nOutdoor amenities include an infinity pool, spa, fire pit, and outdoor kitchen perfect for entertaining.",
                'location' => 'Hollywood Hills, California',
                'is_featured' => false,
                'is_completed' => false,
                'is_ongoing' => true,
                'features_amenities' => ['Swimming Pool', 'Garden', 'Parking', 'Security', 'Terrace', 'CCTV'],
                'bedrooms' => 5,
                'bathrooms' => 6,
                'sqft' => 6800.00,
                'year_built' => 2024,
                'property_type' => 'Estate',
                'images' => [
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Mediterranean Villa Paradise',
                'description' => "Transport yourself to the Mediterranean with this stunning villa featuring authentic architecture and luxurious appointments. Terracotta tiles, wrought iron details, and lush courtyards create an enchanting atmosphere. \n\nThe property includes formal living and dining rooms, a chef's kitchen, wine cellar, and a spectacular master suite with spa-like bathroom. \n\nOutdoor living spaces include covered terraces, a resort-style pool with waterfall, outdoor kitchen, and beautifully landscaped gardens with fountain.",
                'location' => 'Paradise Valley, Arizona',
                'is_featured' => false,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Swimming Pool', 'Garden', 'Parking', 'Security', 'Balcony', 'Terrace'],
                'bedrooms' => 6,
                'bathrooms' => 7,
                'sqft' => 7800.00,
                'year_built' => 2019,
                'property_type' => 'Villa',
                'images' => [
                    'https://images.unsplash.com/photo-1600047509358-9dc75507daeb?w=800',
                    'https://images.unsplash.com/photo-1600585154084-4e5fe7c39198?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Urban Luxury Townhouse',
                'description' => "Experience sophisticated city living in this exquisite townhouse located in the heart of downtown. This contemporary home features high-end finishes, smart home technology, and private outdoor space. \n\nThe main level offers an open-concept living and dining area with chef's kitchen. Upper levels include luxurious bedrooms and a rooftop terrace with skyline views. \n\nBuilding amenities include secure parking, fitness center, and 24-hour concierge service.",
                'location' => 'Manhattan, New York',
                'is_featured' => false,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Gym', 'Parking', 'Security', 'Elevator', 'Terrace', 'CCTV', 'Power Backup'],
                'bedrooms' => 3,
                'bathrooms' => 4,
                'sqft' => 3500.00,
                'year_built' => 2022,
                'property_type' => 'Townhouse',
                'images' => [
                    'https://images.unsplash.com/photo-1600585154363-67eb9e2e2099?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Coastal Modern Masterpiece',
                'description' => "This architectural gem combines modern design with coastal elegance. Featuring clean lines, natural materials, and expansive glass walls, the home offers stunning ocean views from every room. \n\nThe open floor plan includes a gourmet kitchen with top-of-the-line appliances, dining area, and living space that flows to outdoor terraces. The master suite is a private retreat with ocean-view balcony and spa bathroom. \n\nOutdoor amenities include an infinity pool, spa, fire features, and multiple entertaining areas.",
                'location' => 'Laguna Beach, California',
                'is_featured' => true,
                'is_completed' => false,
                'is_ongoing' => true,
                'features_amenities' => ['Swimming Pool', 'Gym', 'Garden', 'Parking', 'Security', 'Balcony', 'Terrace', 'CCTV'],
                'bedrooms' => 5,
                'bathrooms' => 6,
                'sqft' => 6500.00,
                'year_built' => 2024,
                'property_type' => 'Villa',
                'images' => [
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Desert Oasis Estate',
                'description' => "Experience resort-style living in this stunning desert estate. Featuring contemporary architecture, this home is designed to take advantage of mountain views and spectacular sunsets. \n\nThe property includes walls of disappearing glass doors, creating seamless indoor-outdoor living. Amenities include a resort-style pool and spa, outdoor kitchen, fire pit, and putting green. \n\nThe interior showcases high ceilings, custom lighting, and designer finishes throughout.",
                'location' => 'Scottsdale, Arizona',
                'is_featured' => false,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Swimming Pool', 'Garden', 'Parking', 'Security', 'Terrace', 'Clubhouse'],
                'bedrooms' => 4,
                'bathrooms' => 5,
                'sqft' => 5500.00,
                'year_built' => 2021,
                'property_type' => 'Estate',
                'images' => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                ],
                'brochure' => null,
            ],
            [
                'title' => 'Luxury Golf Course Villa',
                'description' => "This exceptional villa offers stunning golf course and mountain views in an exclusive gated community. The home features elegant design, high-end finishes, and luxurious amenities throughout. \n\nThe great room with soaring ceilings flows to a gourmet kitchen with top appliances and large island. The master suite includes a sitting area, dual closets, and spa bathroom. \n\nOutdoor living includes a covered patio, built-in BBQ, pool, spa, and beautifully landscaped yard with putting green.",
                'location' => 'Palm Springs, California',
                'is_featured' => false,
                'is_completed' => true,
                'is_ongoing' => false,
                'features_amenities' => ['Swimming Pool', 'Gym', 'Garden', 'Parking', 'Security', 'Clubhouse', 'CCTV'],
                'bedrooms' => 5,
                'bathrooms' => 6,
                'sqft' => 6200.00,
                'year_built' => 2020,
                'property_type' => 'Villa',
                'images' => [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                    'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=800',
                ],
                'brochure' => null,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $this->command->info('Projects seeded successfully!');
        $this->command->info('Total projects created: ' . count($projects));
    }
}
