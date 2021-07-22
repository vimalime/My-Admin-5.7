<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::post('product-categories/parse-csv-import', 'ProductCategoryController@parseCsvImport')->name('product-categories.parseCsvImport');
    Route::post('product-categories/process-csv-import', 'ProductCategoryController@processCsvImport')->name('product-categories.processCsvImport');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::post('product-tags/parse-csv-import', 'ProductTagController@parseCsvImport')->name('product-tags.parseCsvImport');
    Route::post('product-tags/process-csv-import', 'ProductTagController@processCsvImport')->name('product-tags.processCsvImport');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::post('user-alerts/parse-csv-import', 'UserAlertsController@parseCsvImport')->name('user-alerts.parseCsvImport');
    Route::post('user-alerts/process-csv-import', 'UserAlertsController@processCsvImport')->name('user-alerts.processCsvImport');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::post('faq-categories/parse-csv-import', 'FaqCategoryController@parseCsvImport')->name('faq-categories.parseCsvImport');
    Route::post('faq-categories/process-csv-import', 'FaqCategoryController@processCsvImport')->name('faq-categories.processCsvImport');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::post('faq-questions/parse-csv-import', 'FaqQuestionController@parseCsvImport')->name('faq-questions.parseCsvImport');
    Route::post('faq-questions/process-csv-import', 'FaqQuestionController@processCsvImport')->name('faq-questions.processCsvImport');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::post('countries/parse-csv-import', 'CountriesController@parseCsvImport')->name('countries.parseCsvImport');
    Route::post('countries/process-csv-import', 'CountriesController@processCsvImport')->name('countries.processCsvImport');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::post('states/parse-csv-import', 'StatesController@parseCsvImport')->name('states.parseCsvImport');
    Route::post('states/process-csv-import', 'StatesController@processCsvImport')->name('states.processCsvImport');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CitiesController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CitiesController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CitiesController');

    // Template
    Route::delete('templates/destroy', 'TemplateController@massDestroy')->name('templates.massDestroy');
    Route::post('templates/parse-csv-import', 'TemplateController@parseCsvImport')->name('templates.parseCsvImport');
    Route::post('templates/process-csv-import', 'TemplateController@processCsvImport')->name('templates.processCsvImport');
    Route::resource('templates', 'TemplateController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::post('pages/parse-csv-import', 'PageController@parseCsvImport')->name('pages.parseCsvImport');
    Route::post('pages/process-csv-import', 'PageController@processCsvImport')->name('pages.processCsvImport');
    Route::resource('pages', 'PageController');

    // Careers
    Route::delete('careers/destroy', 'CareersController@massDestroy')->name('careers.massDestroy');
    Route::post('careers/media', 'CareersController@storeMedia')->name('careers.storeMedia');
    Route::post('careers/ckmedia', 'CareersController@storeCKEditorImages')->name('careers.storeCKEditorImages');
    Route::post('careers/parse-csv-import', 'CareersController@parseCsvImport')->name('careers.parseCsvImport');
    Route::post('careers/process-csv-import', 'CareersController@processCsvImport')->name('careers.processCsvImport');
    Route::resource('careers', 'CareersController');

    // General
    Route::delete('generals/destroy', 'GeneralController@massDestroy')->name('generals.massDestroy');
    Route::post('generals/media', 'GeneralController@storeMedia')->name('generals.storeMedia');
    Route::post('generals/ckmedia', 'GeneralController@storeCKEditorImages')->name('generals.storeCKEditorImages');
    Route::post('generals/parse-csv-import', 'GeneralController@parseCsvImport')->name('generals.parseCsvImport');
    Route::post('generals/process-csv-import', 'GeneralController@processCsvImport')->name('generals.processCsvImport');
    Route::resource('generals', 'GeneralController');

    // Email
    Route::delete('emails/destroy', 'EmailController@massDestroy')->name('emails.massDestroy');
    Route::resource('emails', 'EmailController');

    // Permalink
    Route::delete('permalinks/destroy', 'PermalinkController@massDestroy')->name('permalinks.massDestroy');
    Route::resource('permalinks', 'PermalinkController');

    // Property Type
    Route::delete('property-types/destroy', 'PropertyTypeController@massDestroy')->name('property-types.massDestroy');
    Route::resource('property-types', 'PropertyTypeController');

    // Property Features
    Route::delete('property-features/destroy', 'PropertyFeaturesController@massDestroy')->name('property-features.massDestroy');
    Route::post('property-features/parse-csv-import', 'PropertyFeaturesController@parseCsvImport')->name('property-features.parseCsvImport');
    Route::post('property-features/process-csv-import', 'PropertyFeaturesController@processCsvImport')->name('property-features.processCsvImport');
    Route::resource('property-features', 'PropertyFeaturesController');

    // Facilities
    Route::delete('facilities/destroy', 'FacilitiesController@massDestroy')->name('facilities.massDestroy');
    Route::post('facilities/parse-csv-import', 'FacilitiesController@parseCsvImport')->name('facilities.parseCsvImport');
    Route::post('facilities/process-csv-import', 'FacilitiesController@processCsvImport')->name('facilities.processCsvImport');
    Route::resource('facilities', 'FacilitiesController');

    // Investors
    Route::delete('investors/destroy', 'InvestorsController@massDestroy')->name('investors.massDestroy');
    Route::post('investors/parse-csv-import', 'InvestorsController@parseCsvImport')->name('investors.parseCsvImport');
    Route::post('investors/process-csv-import', 'InvestorsController@processCsvImport')->name('investors.processCsvImport');
    Route::resource('investors', 'InvestorsController');

    // Projects
    Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectsController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectsController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::post('projects/parse-csv-import', 'ProjectsController@parseCsvImport')->name('projects.parseCsvImport');
    Route::post('projects/process-csv-import', 'ProjectsController@processCsvImport')->name('projects.processCsvImport');
    Route::resource('projects', 'ProjectsController');

    // Properties
    Route::delete('properties/destroy', 'PropertiesController@massDestroy')->name('properties.massDestroy');
    Route::post('properties/media', 'PropertiesController@storeMedia')->name('properties.storeMedia');
    Route::post('properties/ckmedia', 'PropertiesController@storeCKEditorImages')->name('properties.storeCKEditorImages');
    Route::post('properties/parse-csv-import', 'PropertiesController@parseCsvImport')->name('properties.parseCsvImport');
    Route::post('properties/process-csv-import', 'PropertiesController@processCsvImport')->name('properties.processCsvImport');
    Route::resource('properties', 'PropertiesController');

    // Blog Categories
    Route::delete('blog-categories/destroy', 'BlogCategoriesController@massDestroy')->name('blog-categories.massDestroy');
    Route::post('blog-categories/media', 'BlogCategoriesController@storeMedia')->name('blog-categories.storeMedia');
    Route::post('blog-categories/ckmedia', 'BlogCategoriesController@storeCKEditorImages')->name('blog-categories.storeCKEditorImages');
    Route::post('blog-categories/parse-csv-import', 'BlogCategoriesController@parseCsvImport')->name('blog-categories.parseCsvImport');
    Route::post('blog-categories/process-csv-import', 'BlogCategoriesController@processCsvImport')->name('blog-categories.processCsvImport');
    Route::resource('blog-categories', 'BlogCategoriesController');

    // Blog Tags
    Route::delete('blog-tags/destroy', 'BlogTagsController@massDestroy')->name('blog-tags.massDestroy');
    Route::post('blog-tags/parse-csv-import', 'BlogTagsController@parseCsvImport')->name('blog-tags.parseCsvImport');
    Route::post('blog-tags/process-csv-import', 'BlogTagsController@processCsvImport')->name('blog-tags.processCsvImport');
    Route::resource('blog-tags', 'BlogTagsController');

    // Blogs
    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogsController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogsController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::post('blogs/parse-csv-import', 'BlogsController@parseCsvImport')->name('blogs.parseCsvImport');
    Route::post('blogs/process-csv-import', 'BlogsController@processCsvImport')->name('blogs.processCsvImport');
    Route::resource('blogs', 'BlogsController');

    // Packages
    Route::delete('packages/destroy', 'PackagesController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackagesController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackagesController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::post('packages/parse-csv-import', 'PackagesController@parseCsvImport')->name('packages.parseCsvImport');
    Route::post('packages/process-csv-import', 'PackagesController@processCsvImport')->name('packages.processCsvImport');
    Route::resource('packages', 'PackagesController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::post('contacts/parse-csv-import', 'ContactController@parseCsvImport')->name('contacts.parseCsvImport');
    Route::post('contacts/process-csv-import', 'ContactController@processCsvImport')->name('contacts.processCsvImport');
    Route::resource('contacts', 'ContactController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::post('testimonials/media', 'TestimonialController@storeMedia')->name('testimonials.storeMedia');
    Route::post('testimonials/ckmedia', 'TestimonialController@storeCKEditorImages')->name('testimonials.storeCKEditorImages');
    Route::post('testimonials/parse-csv-import', 'TestimonialController@parseCsvImport')->name('testimonials.parseCsvImport');
    Route::post('testimonials/process-csv-import', 'TestimonialController@processCsvImport')->name('testimonials.processCsvImport');
    Route::resource('testimonials', 'TestimonialController');

    // Reviews
    Route::delete('reviews/destroy', 'ReviewsController@massDestroy')->name('reviews.massDestroy');
    Route::post('reviews/parse-csv-import', 'ReviewsController@parseCsvImport')->name('reviews.parseCsvImport');
    Route::post('reviews/process-csv-import', 'ReviewsController@processCsvImport')->name('reviews.processCsvImport');
    Route::resource('reviews', 'ReviewsController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::post('sliders/parse-csv-import', 'SliderController@parseCsvImport')->name('sliders.parseCsvImport');
    Route::post('sliders/process-csv-import', 'SliderController@processCsvImport')->name('sliders.processCsvImport');
    Route::resource('sliders', 'SliderController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Template
    Route::delete('templates/destroy', 'TemplateController@massDestroy')->name('templates.massDestroy');
    Route::resource('templates', 'TemplateController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::resource('pages', 'PageController');

    // Careers
    Route::delete('careers/destroy', 'CareersController@massDestroy')->name('careers.massDestroy');
    Route::post('careers/media', 'CareersController@storeMedia')->name('careers.storeMedia');
    Route::post('careers/ckmedia', 'CareersController@storeCKEditorImages')->name('careers.storeCKEditorImages');
    Route::resource('careers', 'CareersController');

    // General
    Route::delete('generals/destroy', 'GeneralController@massDestroy')->name('generals.massDestroy');
    Route::post('generals/media', 'GeneralController@storeMedia')->name('generals.storeMedia');
    Route::post('generals/ckmedia', 'GeneralController@storeCKEditorImages')->name('generals.storeCKEditorImages');
    Route::resource('generals', 'GeneralController');

    // Email
    Route::delete('emails/destroy', 'EmailController@massDestroy')->name('emails.massDestroy');
    Route::resource('emails', 'EmailController');

    // Permalink
    Route::delete('permalinks/destroy', 'PermalinkController@massDestroy')->name('permalinks.massDestroy');
    Route::resource('permalinks', 'PermalinkController');

    // Property Type
    Route::delete('property-types/destroy', 'PropertyTypeController@massDestroy')->name('property-types.massDestroy');
    Route::resource('property-types', 'PropertyTypeController');

    // Property Features
    Route::delete('property-features/destroy', 'PropertyFeaturesController@massDestroy')->name('property-features.massDestroy');
    Route::resource('property-features', 'PropertyFeaturesController');

    // Facilities
    Route::delete('facilities/destroy', 'FacilitiesController@massDestroy')->name('facilities.massDestroy');
    Route::resource('facilities', 'FacilitiesController');

    // Investors
    Route::delete('investors/destroy', 'InvestorsController@massDestroy')->name('investors.massDestroy');
    Route::resource('investors', 'InvestorsController');

    // Projects
    Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectsController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectsController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::resource('projects', 'ProjectsController');

    // Properties
    Route::delete('properties/destroy', 'PropertiesController@massDestroy')->name('properties.massDestroy');
    Route::post('properties/media', 'PropertiesController@storeMedia')->name('properties.storeMedia');
    Route::post('properties/ckmedia', 'PropertiesController@storeCKEditorImages')->name('properties.storeCKEditorImages');
    Route::resource('properties', 'PropertiesController');

    // Blog Categories
    Route::delete('blog-categories/destroy', 'BlogCategoriesController@massDestroy')->name('blog-categories.massDestroy');
    Route::post('blog-categories/media', 'BlogCategoriesController@storeMedia')->name('blog-categories.storeMedia');
    Route::post('blog-categories/ckmedia', 'BlogCategoriesController@storeCKEditorImages')->name('blog-categories.storeCKEditorImages');
    Route::resource('blog-categories', 'BlogCategoriesController');

    // Blog Tags
    Route::delete('blog-tags/destroy', 'BlogTagsController@massDestroy')->name('blog-tags.massDestroy');
    Route::resource('blog-tags', 'BlogTagsController');

    // Blogs
    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogsController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogsController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogsController');

    // Packages
    Route::delete('packages/destroy', 'PackagesController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackagesController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackagesController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::resource('packages', 'PackagesController');

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::post('testimonials/media', 'TestimonialController@storeMedia')->name('testimonials.storeMedia');
    Route::post('testimonials/ckmedia', 'TestimonialController@storeCKEditorImages')->name('testimonials.storeCKEditorImages');
    Route::resource('testimonials', 'TestimonialController');

    // Reviews
    Route::delete('reviews/destroy', 'ReviewsController@massDestroy')->name('reviews.massDestroy');
    Route::resource('reviews', 'ReviewsController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
