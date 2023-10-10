<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminConfigSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(BankTransferSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(CurrencyCodeMasterSeeder::class);
        $this->call(CurrencyRateSeeder::class);
        $this->call(HowToBuySeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(ProviderDetailSeeder::class);
        $this->call(SiteCommonContentSeeder::class);
        $this->call(TermsAndConditionSeeder::class);
        $this->call(TaxManagementSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(WhyChooseSeeder::class);
    }
}
