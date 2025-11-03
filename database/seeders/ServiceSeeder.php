<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Property Buying',
                'descriptions' => 'We help you find and purchase your dream property with expert guidance throughout the entire buying process. Our experienced team assists with property search, negotiations, documentation, and ensures a smooth transaction from start to finish. Whether you\'re looking for a luxury villa, apartment, or commercial space, we provide personalized service tailored to your needs and budget.',
                'meta_title' => 'Property Buying Services | Gurukrupa Marketing',
                'meta_description' => 'Expert property buying assistance. Find your dream home with our comprehensive real estate buying services, from search to closing.',
                'meta_keywords' => 'property buying, home buying, real estate purchase, buy property, property search',
            ],
            [
                'title' => 'Property Selling',
                'descriptions' => 'Maximize your property value with our professional selling services. We provide comprehensive market analysis, strategic pricing, professional photography, extensive marketing campaigns, and skilled negotiation to ensure you get the best price for your property. Our proven track record and wide network of buyers help you sell faster and at optimal rates.',
                'meta_title' => 'Property Selling Services | Gurukrupa Marketing',
                'meta_description' => 'Sell your property quickly and at the best price. Professional real estate selling services with expert marketing and negotiation.',
                'meta_keywords' => 'property selling, sell home, real estate sales, property marketing, home selling',
            ],
            [
                'title' => 'Property Rental',
                'descriptions' => 'Find the perfect rental property or reliable tenants through our comprehensive rental services. We handle everything from property listing, tenant screening, lease agreements, to ongoing property management. For property owners, we ensure consistent rental income with quality tenants. For renters, we help you find properties that match your lifestyle and budget.',
                'meta_title' => 'Property Rental Services | Gurukrupa Marketing',
                'meta_description' => 'Complete rental solutions for property owners and tenants. Find rental properties or quality tenants with our expert services.',
                'meta_keywords' => 'property rental, rent property, rental services, tenant finding, rental management',
            ],
            [
                'title' => 'Investment Consulting',
                'descriptions' => 'Make informed real estate investment decisions with our expert consulting services. We provide detailed market research, ROI analysis, investment strategies, and portfolio diversification advice. Our consultants help you identify lucrative opportunities, assess risks, and maximize returns on your real estate investments. Perfect for both first-time and experienced investors.',
                'meta_title' => 'Real Estate Investment Consulting | Gurukrupa Marketing',
                'meta_description' => 'Expert real estate investment consulting. Maximize your ROI with professional market analysis and strategic investment guidance.',
                'meta_keywords' => 'investment consulting, real estate investment, property investment, ROI analysis, investment advice',
            ],
            [
                'title' => 'Property Management',
                'descriptions' => 'Comprehensive property management services to maintain and maximize the value of your real estate assets. We handle tenant relations, rent collection, maintenance coordination, legal compliance, and financial reporting. Our professional management ensures your property remains in excellent condition while generating consistent returns with minimal hassle for you.',
                'meta_title' => 'Property Management Services | Gurukrupa Marketing',
                'meta_description' => 'Professional property management services. We handle all aspects of property maintenance, tenant management, and financial reporting.',
                'meta_keywords' => 'property management, property maintenance, tenant management, rental management, property care',
            ],
            [
                'title' => 'Legal Assistance',
                'descriptions' => 'Navigate complex real estate legal matters with confidence through our expert legal assistance services. We provide support with property documentation, title verification, contract review, registration processes, and dispute resolution. Our legal team ensures all transactions are compliant with current regulations and your interests are fully protected throughout the process.',
                'meta_title' => 'Real Estate Legal Assistance | Gurukrupa Marketing',
                'meta_description' => 'Expert legal assistance for real estate transactions. Complete support for documentation, contracts, and property legal matters.',
                'meta_keywords' => 'legal assistance, property legal, real estate law, property documentation, legal services',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $this->command->info('Services seeded successfully!');
    }
}
