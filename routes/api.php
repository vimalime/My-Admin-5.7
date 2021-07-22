<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tag
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Faq Category
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Question
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Lessons
    Route::post('lessons/media', 'LessonsApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonsApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Question Options
    Route::apiResource('question-options', 'QuestionOptionsApiController');

    // Test Results
    Route::apiResource('test-results', 'TestResultsApiController');

    // Test Answers
    Route::apiResource('test-answers', 'TestAnswersApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // States
    Route::apiResource('states', 'StatesApiController');

    // Cities
    Route::apiResource('cities', 'CitiesApiController');

    // Template
    Route::apiResource('templates', 'TemplateApiController');

    // Page
    Route::post('pages/media', 'PageApiController@storeMedia')->name('pages.storeMedia');
    Route::apiResource('pages', 'PageApiController');

    // Careers
    Route::post('careers/media', 'CareersApiController@storeMedia')->name('careers.storeMedia');
    Route::apiResource('careers', 'CareersApiController');

    // General
    Route::post('generals/media', 'GeneralApiController@storeMedia')->name('generals.storeMedia');
    Route::apiResource('generals', 'GeneralApiController');

    // Email
    Route::apiResource('emails', 'EmailApiController');

    // Permalink
    Route::apiResource('permalinks', 'PermalinkApiController');

    // Property Type
    Route::apiResource('property-types', 'PropertyTypeApiController');

    // Property Features
    Route::apiResource('property-features', 'PropertyFeaturesApiController');

    // Facilities
    Route::apiResource('facilities', 'FacilitiesApiController');

    // Investors
    Route::apiResource('investors', 'InvestorsApiController');

    // Projects
    Route::post('projects/media', 'ProjectsApiController@storeMedia')->name('projects.storeMedia');
    Route::apiResource('projects', 'ProjectsApiController');

    // Properties
    Route::post('properties/media', 'PropertiesApiController@storeMedia')->name('properties.storeMedia');
    Route::apiResource('properties', 'PropertiesApiController');

    // Blog Categories
    Route::post('blog-categories/media', 'BlogCategoriesApiController@storeMedia')->name('blog-categories.storeMedia');
    Route::apiResource('blog-categories', 'BlogCategoriesApiController');

    // Blog Tags
    Route::apiResource('blog-tags', 'BlogTagsApiController');

    // Blogs
    Route::post('blogs/media', 'BlogsApiController@storeMedia')->name('blogs.storeMedia');
    Route::apiResource('blogs', 'BlogsApiController');

    // Packages
    Route::post('packages/media', 'PackagesApiController@storeMedia')->name('packages.storeMedia');
    Route::apiResource('packages', 'PackagesApiController');

    // Contact
    Route::apiResource('contacts', 'ContactApiController');

    // Testimonial
    Route::post('testimonials/media', 'TestimonialApiController@storeMedia')->name('testimonials.storeMedia');
    Route::apiResource('testimonials', 'TestimonialApiController');

    // Reviews
    Route::apiResource('reviews', 'ReviewsApiController');

    // Slider
    Route::post('sliders/media', 'SliderApiController@storeMedia')->name('sliders.storeMedia');
    Route::apiResource('sliders', 'SliderApiController');
});
