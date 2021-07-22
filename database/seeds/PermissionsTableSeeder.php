<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 38,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 39,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 40,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 41,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 42,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 43,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 44,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 45,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 46,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 47,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 48,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 49,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 50,
                'title' => 'course_create',
            ],
            [
                'id'    => 51,
                'title' => 'course_edit',
            ],
            [
                'id'    => 52,
                'title' => 'course_show',
            ],
            [
                'id'    => 53,
                'title' => 'course_delete',
            ],
            [
                'id'    => 54,
                'title' => 'course_access',
            ],
            [
                'id'    => 55,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 56,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 57,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 58,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 59,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 60,
                'title' => 'test_create',
            ],
            [
                'id'    => 61,
                'title' => 'test_edit',
            ],
            [
                'id'    => 62,
                'title' => 'test_show',
            ],
            [
                'id'    => 63,
                'title' => 'test_delete',
            ],
            [
                'id'    => 64,
                'title' => 'test_access',
            ],
            [
                'id'    => 65,
                'title' => 'question_create',
            ],
            [
                'id'    => 66,
                'title' => 'question_edit',
            ],
            [
                'id'    => 67,
                'title' => 'question_show',
            ],
            [
                'id'    => 68,
                'title' => 'question_delete',
            ],
            [
                'id'    => 69,
                'title' => 'question_access',
            ],
            [
                'id'    => 70,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 71,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 72,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 73,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 74,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 75,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 76,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 77,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 78,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 79,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 80,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 81,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 82,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 83,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 84,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 85,
                'title' => 'location_management_access',
            ],
            [
                'id'    => 86,
                'title' => 'country_create',
            ],
            [
                'id'    => 87,
                'title' => 'country_edit',
            ],
            [
                'id'    => 88,
                'title' => 'country_show',
            ],
            [
                'id'    => 89,
                'title' => 'country_delete',
            ],
            [
                'id'    => 90,
                'title' => 'country_access',
            ],
            [
                'id'    => 91,
                'title' => 'state_create',
            ],
            [
                'id'    => 92,
                'title' => 'state_edit',
            ],
            [
                'id'    => 93,
                'title' => 'state_show',
            ],
            [
                'id'    => 94,
                'title' => 'state_delete',
            ],
            [
                'id'    => 95,
                'title' => 'state_access',
            ],
            [
                'id'    => 96,
                'title' => 'city_create',
            ],
            [
                'id'    => 97,
                'title' => 'city_edit',
            ],
            [
                'id'    => 98,
                'title' => 'city_show',
            ],
            [
                'id'    => 99,
                'title' => 'city_delete',
            ],
            [
                'id'    => 100,
                'title' => 'city_access',
            ],
            [
                'id'    => 101,
                'title' => 'template_create',
            ],
            [
                'id'    => 102,
                'title' => 'template_edit',
            ],
            [
                'id'    => 103,
                'title' => 'template_show',
            ],
            [
                'id'    => 104,
                'title' => 'template_delete',
            ],
            [
                'id'    => 105,
                'title' => 'template_access',
            ],
            [
                'id'    => 106,
                'title' => 'page_create',
            ],
            [
                'id'    => 107,
                'title' => 'page_edit',
            ],
            [
                'id'    => 108,
                'title' => 'page_show',
            ],
            [
                'id'    => 109,
                'title' => 'page_delete',
            ],
            [
                'id'    => 110,
                'title' => 'page_access',
            ],
            [
                'id'    => 111,
                'title' => 'blog_management_access',
            ],
            [
                'id'    => 112,
                'title' => 'career_create',
            ],
            [
                'id'    => 113,
                'title' => 'career_edit',
            ],
            [
                'id'    => 114,
                'title' => 'career_show',
            ],
            [
                'id'    => 115,
                'title' => 'career_delete',
            ],
            [
                'id'    => 116,
                'title' => 'career_access',
            ],
            [
                'id'    => 117,
                'title' => 'settings_management_access',
            ],
            [
                'id'    => 118,
                'title' => 'general_create',
            ],
            [
                'id'    => 119,
                'title' => 'general_edit',
            ],
            [
                'id'    => 120,
                'title' => 'general_show',
            ],
            [
                'id'    => 121,
                'title' => 'general_delete',
            ],
            [
                'id'    => 122,
                'title' => 'general_access',
            ],
            [
                'id'    => 123,
                'title' => 'email_create',
            ],
            [
                'id'    => 124,
                'title' => 'email_edit',
            ],
            [
                'id'    => 125,
                'title' => 'email_show',
            ],
            [
                'id'    => 126,
                'title' => 'email_delete',
            ],
            [
                'id'    => 127,
                'title' => 'email_access',
            ],
            [
                'id'    => 128,
                'title' => 'permalink_create',
            ],
            [
                'id'    => 129,
                'title' => 'permalink_edit',
            ],
            [
                'id'    => 130,
                'title' => 'permalink_show',
            ],
            [
                'id'    => 131,
                'title' => 'permalink_delete',
            ],
            [
                'id'    => 132,
                'title' => 'permalink_access',
            ],
            [
                'id'    => 133,
                'title' => 'real_estate_access',
            ],
            [
                'id'    => 134,
                'title' => 'property_type_create',
            ],
            [
                'id'    => 135,
                'title' => 'property_type_edit',
            ],
            [
                'id'    => 136,
                'title' => 'property_type_show',
            ],
            [
                'id'    => 137,
                'title' => 'property_type_delete',
            ],
            [
                'id'    => 138,
                'title' => 'property_type_access',
            ],
            [
                'id'    => 139,
                'title' => 'property_feature_create',
            ],
            [
                'id'    => 140,
                'title' => 'property_feature_edit',
            ],
            [
                'id'    => 141,
                'title' => 'property_feature_show',
            ],
            [
                'id'    => 142,
                'title' => 'property_feature_delete',
            ],
            [
                'id'    => 143,
                'title' => 'property_feature_access',
            ],
            [
                'id'    => 144,
                'title' => 'facility_create',
            ],
            [
                'id'    => 145,
                'title' => 'facility_edit',
            ],
            [
                'id'    => 146,
                'title' => 'facility_show',
            ],
            [
                'id'    => 147,
                'title' => 'facility_delete',
            ],
            [
                'id'    => 148,
                'title' => 'facility_access',
            ],
            [
                'id'    => 149,
                'title' => 'investor_create',
            ],
            [
                'id'    => 150,
                'title' => 'investor_edit',
            ],
            [
                'id'    => 151,
                'title' => 'investor_show',
            ],
            [
                'id'    => 152,
                'title' => 'investor_delete',
            ],
            [
                'id'    => 153,
                'title' => 'investor_access',
            ],
            [
                'id'    => 154,
                'title' => 'project_create',
            ],
            [
                'id'    => 155,
                'title' => 'project_edit',
            ],
            [
                'id'    => 156,
                'title' => 'project_show',
            ],
            [
                'id'    => 157,
                'title' => 'project_delete',
            ],
            [
                'id'    => 158,
                'title' => 'project_access',
            ],
            [
                'id'    => 159,
                'title' => 'property_create',
            ],
            [
                'id'    => 160,
                'title' => 'property_edit',
            ],
            [
                'id'    => 161,
                'title' => 'property_show',
            ],
            [
                'id'    => 162,
                'title' => 'property_delete',
            ],
            [
                'id'    => 163,
                'title' => 'property_access',
            ],
            [
                'id'    => 164,
                'title' => 'blog_category_create',
            ],
            [
                'id'    => 165,
                'title' => 'blog_category_edit',
            ],
            [
                'id'    => 166,
                'title' => 'blog_category_show',
            ],
            [
                'id'    => 167,
                'title' => 'blog_category_delete',
            ],
            [
                'id'    => 168,
                'title' => 'blog_category_access',
            ],
            [
                'id'    => 169,
                'title' => 'blog_tag_create',
            ],
            [
                'id'    => 170,
                'title' => 'blog_tag_edit',
            ],
            [
                'id'    => 171,
                'title' => 'blog_tag_show',
            ],
            [
                'id'    => 172,
                'title' => 'blog_tag_delete',
            ],
            [
                'id'    => 173,
                'title' => 'blog_tag_access',
            ],
            [
                'id'    => 174,
                'title' => 'blog_create',
            ],
            [
                'id'    => 175,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 176,
                'title' => 'blog_show',
            ],
            [
                'id'    => 177,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 178,
                'title' => 'blog_access',
            ],
            [
                'id'    => 179,
                'title' => 'package_create',
            ],
            [
                'id'    => 180,
                'title' => 'package_edit',
            ],
            [
                'id'    => 181,
                'title' => 'package_show',
            ],
            [
                'id'    => 182,
                'title' => 'package_delete',
            ],
            [
                'id'    => 183,
                'title' => 'package_access',
            ],
            [
                'id'    => 184,
                'title' => 'contact_create',
            ],
            [
                'id'    => 185,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 186,
                'title' => 'contact_show',
            ],
            [
                'id'    => 187,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 188,
                'title' => 'contact_access',
            ],
            [
                'id'    => 189,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 190,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 191,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 192,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 193,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 194,
                'title' => 'review_create',
            ],
            [
                'id'    => 195,
                'title' => 'review_edit',
            ],
            [
                'id'    => 196,
                'title' => 'review_show',
            ],
            [
                'id'    => 197,
                'title' => 'review_delete',
            ],
            [
                'id'    => 198,
                'title' => 'review_access',
            ],
            [
                'id'    => 199,
                'title' => 'slider_create',
            ],
            [
                'id'    => 200,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 201,
                'title' => 'slider_show',
            ],
            [
                'id'    => 202,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 203,
                'title' => 'slider_access',
            ],
            [
                'id'    => 204,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
