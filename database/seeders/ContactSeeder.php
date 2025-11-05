<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '(555) 123-4567',
                'subject' => 'Product Inquiry',
                'message' => 'Hello, I am interested in purchasing your Kronic Kustoms Edge Topper for my 2023 Jeep Gladiator. Could you please provide more information about shipping times and customization options?',
                'read' => false,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.j@example.com',
                'phone' => '(555) 234-5678',
                'subject' => 'Pre-Order Question',
                'message' => 'I would like to place a pre-order for the Edge Topper. What is the deposit amount and when would I need to pay the remaining balance? Also, are there any color options available?',
                'read' => false,
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'phone' => '(555) 345-6789',
                'subject' => 'Installation Support',
                'message' => 'I recently purchased your Edge Topper and need help with installation. Do you provide installation instructions or can you recommend a local installer in the Phoenix area?',
                'read' => true,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'phone' => null,
                'subject' => 'Warranty Information',
                'message' => 'What is the warranty coverage for the Edge Topper? I want to make sure I understand what is covered before making my purchase decision.',
                'read' => false,
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert.wilson@example.com',
                'phone' => '(555) 456-7890',
                'subject' => 'Bulk Order Inquiry',
                'message' => 'I own a dealership and would like to order 10 units. Do you offer any volume discounts? Also, what would be the lead time for this quantity?',
                'read' => true,
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.m@example.com',
                'phone' => '(555) 567-8901',
                'subject' => 'Product Availability',
                'message' => 'When will the Edge Topper be back in stock? I see it\'s currently showing as limited availability. Also, do you ship to Canada?',
                'read' => true,
                'created_at' => Carbon::now()->subDays(4),
            ],
            [
                'name' => 'David Anderson',
                'email' => 'david.anderson@example.com',
                'phone' => null,
                'subject' => 'Customization Options',
                'message' => 'I\'m interested in custom paint options for the topper. Do you offer custom color matching? What additional costs would be involved?',
                'read' => false,
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'name' => 'Lisa Thompson',
                'email' => 'lisa.thompson@example.com',
                'phone' => '(555) 678-9012',
                'subject' => 'Return Policy',
                'message' => 'What is your return policy if the product doesn\'t fit my Jeep Gladiator? I want to make sure I can return it if there are any issues.',
                'read' => true,
                'created_at' => Carbon::now()->subDays(6),
            ],
            [
                'name' => 'James Taylor',
                'email' => 'james.taylor@example.com',
                'phone' => '(555) 789-0123',
                'subject' => 'Product Features',
                'message' => 'Can you provide more details about the features of the Edge Topper? I\'m particularly interested in the locking mechanism and weatherproofing capabilities.',
                'read' => false,
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'name' => 'Amanda White',
                'email' => 'amanda.white@example.com',
                'phone' => '(555) 890-1234',
                'subject' => 'Shipping Information',
                'message' => 'How long does shipping typically take? I need the topper by next month for a camping trip. Also, is expedited shipping available?',
                'read' => true,
                'created_at' => Carbon::now()->subDays(8),
            ],
            [
                'name' => 'Christopher Lee',
                'email' => 'chris.lee@example.com',
                'phone' => null,
                'subject' => 'Technical Specifications',
                'message' => 'I need the technical specifications and dimensions of the Edge Topper. I want to make sure it will fit properly with my roof rack and other accessories.',
                'read' => false,
                'created_at' => Carbon::now()->subDays(9),
            ],
            [
                'name' => 'Michelle Garcia',
                'email' => 'michelle.g@example.com',
                'phone' => '(555) 901-2345',
                'subject' => 'Payment Options',
                'message' => 'What payment methods do you accept? Do you offer financing options or payment plans for larger purchases?',
                'read' => true,
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'name' => 'Daniel Rodriguez',
                'email' => 'daniel.r@example.com',
                'phone' => '(555) 012-3456',
                'subject' => 'Product Comparison',
                'message' => 'How does your Edge Topper compare to other toppers on the market? What makes Kronic Kustoms unique? I\'m doing research before making a purchase.',
                'read' => false,
                'created_at' => Carbon::now()->subDays(11),
            ],
            [
                'name' => 'Jessica Martinez',
                'email' => 'jessica.m@example.com',
                'phone' => '(555) 123-4567',
                'subject' => 'Customer Review',
                'message' => 'I absolutely love my Edge Topper! The quality is outstanding and it looks great on my Gladiator. Thank you for such an amazing product!',
                'read' => true,
                'created_at' => Carbon::now()->subDays(12),
            ],
            [
                'name' => 'Kevin Jackson',
                'email' => 'kevin.jackson@example.com',
                'phone' => null,
                'subject' => 'Accessory Compatibility',
                'message' => 'Will the Edge Topper work with my existing roof rack and LED light bar? I want to make sure all my accessories will still fit properly.',
                'read' => false,
                'created_at' => Carbon::now()->subDays(13),
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
