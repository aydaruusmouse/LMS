<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TimeZoneSeeder::class);
        $this->call(ApiKeySeeder::class);
        //        $this->call(BookSeeder::class);
        //        $this->call(CartSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CategoryLanguageSeeder::class);
        $this->call(CertificateSeeder::class);
        //        $this->call(CheckoutSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(StateSeeder::class);
        // $this->call(CountrySeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(CouponLanguageSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(DemoSeeder::class);
        $this->call(EnrollSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(FaqLanguageSeeder::class);
        $this->call(FlagIconSeeder::class);
        $this->call(FollowSedder::class);
        // $this->call(HomeScreenSeeder::class);
        $this->call(IntructorSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(LessonSeeder::class);
        //        $this->call(MessageSeeder::class);
        $this->call(MeetingSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(WishListSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(SubjectLanguageSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(BlogSeederLanguageSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(FeedbackSeederLanguageSeeder::class);
        $this->call(SuccessStorySeeder::class);
        $this->call(SuccessStoryLanguageSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TagLanguageSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(LevelLanguageSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(TestimonialLanguageSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(QuizQuestionSeeder::class);
        $this->call(PackageSolutionSeed::class);
        $this->call(InstructorPermissionSeeder::class);
        //        $this->call(AccountSeeder::class);
        $this->call(SMSTemplateSeeder::class);
        $this->call(OrganizationStaffSeeder::class);
        $this->call(PageSeeder::class);
    }
}
