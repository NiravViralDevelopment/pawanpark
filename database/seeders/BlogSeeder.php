<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Top 10 Luxury Villa Features Every Buyer Wants',
                'description' => 'When it comes to luxury real estate, discerning buyers have specific expectations. From infinity pools overlooking breathtaking vistas to state-of-the-art home automation systems, today\'s luxury villas must offer more than just square footage. Smart home technology has become a must-have, allowing owners to control everything from lighting to security with a simple voice command. Outdoor living spaces with gourmet kitchens and entertainment areas are no longer optional but essential. Home theaters, wine cellars, and spa-like bathrooms with steam rooms and soaking tubs round out the list of coveted amenities. Location remains paramount, with privacy and stunning views being non-negotiable for most luxury buyers.',
                'posted_by' => 'Sarah Johnson',
                'date' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'The Future of Sustainable Luxury Living',
                'description' => 'Sustainability is no longer just a buzzword in luxury real estate—it\'s a fundamental requirement for forward-thinking buyers. Modern luxury villas are incorporating solar panels, geothermal heating, and rainwater harvesting systems without compromising on comfort or aesthetics. Green building materials such as reclaimed wood, low-VOC paints, and energy-efficient windows are becoming standard. Smart energy management systems optimize power consumption, while advanced insulation and passive solar design reduce environmental impact. Many luxury developments now feature electric vehicle charging stations, organic gardens, and native landscaping that requires minimal water. The integration of sustainability with luxury proves that environmental responsibility and opulent living can coexist beautifully.',
                'posted_by' => 'Michael Chen',
                'date' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Investment Tips: Luxury Real Estate in 2025',
                'description' => 'The luxury real estate market in 2025 presents unique opportunities for savvy investors. Understanding market dynamics is crucial—while traditional vacation hotspots remain strong, emerging markets in secondary cities are offering compelling returns. Diversification across different property types and locations can help mitigate risk. Consider properties with income-generating potential through luxury rentals or vacation platforms. Tax advantages vary by region, so consulting with financial advisors familiar with international real estate is essential. Due diligence is paramount—engage reputable local agents, conduct thorough inspections, and understand local regulations. The rise of remote work has expanded the definition of desirable locations, opening new investment frontiers in areas offering lifestyle benefits beyond traditional urban centers.',
                'posted_by' => 'David Martinez',
                'date' => Carbon::now()->subDays(18),
            ],
            [
                'title' => 'Behind the Design: Modern Villa Architecture',
                'description' => 'Contemporary villa architecture is a masterclass in balancing form and function. Clean lines and minimalist aesthetics dominate current design trends, with floor-to-ceiling windows blurring the boundary between indoor and outdoor spaces. Open-plan layouts create a sense of flow and spaciousness, while carefully positioned walls and partitions offer privacy when needed. Natural materials like stone, wood, and glass are combined with modern elements such as steel and concrete to create visually striking yet warm environments. Sustainable design principles influence everything from building orientation to material selection. Architects are increasingly incorporating biophilic design elements, bringing nature into the living space through indoor gardens, water features, and strategic use of natural light. The result is architecture that not only impresses aesthetically but also enhances the wellbeing of its inhabitants.',
                'posted_by' => 'Emily Rodriguez',
                'date' => Carbon::now()->subDays(25),
            ],
            [
                'title' => 'Guide to Coastal Villa Living: Maintenance & Care',
                'description' => 'Owning a coastal luxury villa offers unparalleled lifestyle benefits, but it also comes with unique maintenance challenges. Salt air accelerates corrosion of metal fixtures, requiring regular inspection and replacement of hardware. Window cleaning becomes a constant task as salt deposits obscure views. Proper drainage systems are essential to prevent water damage during storms. Choose materials wisely—stainless steel, marine-grade aluminum, and composite materials resist coastal elements better than traditional options. Regular HVAC maintenance prevents moisture and salt damage to expensive systems. Landscaping requires salt-tolerant plants and irrigation systems that can handle brackish groundwater. Invest in quality exterior paint and sealants designed for marine environments. Despite these considerations, with proper maintenance planning and working with experienced coastal property managers, your villa will remain a pristine paradise for generations.',
                'posted_by' => 'James Wilson',
                'date' => Carbon::now()->subDays(30),
            ],
            [
                'title' => 'Smart Home Technology in Luxury Villas',
                'description' => 'The integration of smart home technology has revolutionized luxury villa living, offering unprecedented levels of comfort, security, and efficiency. Central control systems allow homeowners to manage lighting, climate, entertainment, and security from a single interface or smartphone app. Voice-activated assistants respond to commands for everything from adjusting room temperature to starting a movie. Advanced security systems include facial recognition, smart locks, and AI-powered surveillance cameras. Automated blinds and lighting systems can be programmed to follow your daily routine or respond to natural light levels. Smart irrigation systems monitor weather forecasts and soil moisture to optimize water usage. Home theaters feature immersive audio systems and 4K or 8K projection. The latest innovations include AI-driven systems that learn your preferences and anticipate your needs, creating a truly personalized living environment.',
                'posted_by' => 'Lisa Anderson',
                'date' => Carbon::now()->subDays(40),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
