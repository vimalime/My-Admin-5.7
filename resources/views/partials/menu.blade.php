<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('audit_log_access')
                            <li class="{{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.audit-logs.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.auditLog.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('page_access')
                <li class="{{ request()->is("admin/pages") || request()->is("admin/pages/*") ? "active" : "" }}">
                    <a href="{{ route("admin.pages.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.page.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('product_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-shopping-cart">

                        </i>
                        <span>{{ trans('cruds.productManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('product_category_access')
                            <li class="{{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.product-categories.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.productCategory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('product_tag_access')
                            <li class="{{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "active" : "" }}">
                                <a href="{{ route("admin.product-tags.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.productTag.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('product_access')
                            <li class="{{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                                <a href="{{ route("admin.products.index") }}">
                                    <i class="fa-fw fas fa-shopping-cart">

                                    </i>
                                    <span>{{ trans('cruds.product.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('blog_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-shopping-cart">

                        </i>
                        <span>{{ trans('cruds.blogManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('blog_category_access')
                            <li class="{{ request()->is("admin/blog-categories") || request()->is("admin/blog-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.blog-categories.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.blogCategory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('blog_tag_access')
                            <li class="{{ request()->is("admin/blog-tags") || request()->is("admin/blog-tags/*") ? "active" : "" }}">
                                <a href="{{ route("admin.blog-tags.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.blogTag.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('blog_access')
                            <li class="{{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.blogs.index") }}">
                                    <i class="fa-fw fas fa-shopping-cart">

                                    </i>
                                    <span>{{ trans('cruds.blog.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('career_access')
                <li class="{{ request()->is("admin/careers") || request()->is("admin/careers/*") ? "active" : "" }}">
                    <a href="{{ route("admin.careers.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.career.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('settings_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-shopping-cart">

                        </i>
                        <span>{{ trans('cruds.settingsManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('general_access')
                            <li class="{{ request()->is("admin/generals") || request()->is("admin/generals/*") ? "active" : "" }}">
                                <a href="{{ route("admin.generals.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.general.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('email_access')
                            <li class="{{ request()->is("admin/emails") || request()->is("admin/emails/*") ? "active" : "" }}">
                                <a href="{{ route("admin.emails.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.email.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('permalink_access')
                            <li class="{{ request()->is("admin/permalinks") || request()->is("admin/permalinks/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permalinks.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.permalink.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('package_access')
                <li class="{{ request()->is("admin/packages") || request()->is("admin/packages/*") ? "active" : "" }}">
                    <a href="{{ route("admin.packages.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.package.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('real_estate_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-book">

                        </i>
                        <span>{{ trans('cruds.realEstate.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('property_access')
                            <li class="{{ request()->is("admin/properties") || request()->is("admin/properties/*") ? "active" : "" }}">
                                <a href="{{ route("admin.properties.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.property.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('project_access')
                            <li class="{{ request()->is("admin/projects") || request()->is("admin/projects/*") ? "active" : "" }}">
                                <a href="{{ route("admin.projects.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.project.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('property_feature_access')
                            <li class="{{ request()->is("admin/property-features") || request()->is("admin/property-features/*") ? "active" : "" }}">
                                <a href="{{ route("admin.property-features.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.propertyFeature.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('facility_access')
                            <li class="{{ request()->is("admin/facilities") || request()->is("admin/facilities/*") ? "active" : "" }}">
                                <a href="{{ route("admin.facilities.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.facility.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('property_type_access')
                            <li class="{{ request()->is("admin/property-types") || request()->is("admin/property-types/*") ? "active" : "" }}">
                                <a href="{{ route("admin.property-types.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.propertyType.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('investor_access')
                            <li class="{{ request()->is("admin/investors") || request()->is("admin/investors/*") ? "active" : "" }}">
                                <a href="{{ route("admin.investors.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.investor.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('location_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.locationManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('country_access')
                            <li class="{{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                <a href="{{ route("admin.countries.index") }}">
                                    <i class="fa-fw fas fa-flag">

                                    </i>
                                    <span>{{ trans('cruds.country.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('state_access')
                            <li class="{{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" : "" }}">
                                <a href="{{ route("admin.states.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.state.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('city_access')
                            <li class="{{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                                <a href="{{ route("admin.cities.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.city.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('template_access')
                <li class="{{ request()->is("admin/templates") || request()->is("admin/templates/*") ? "active" : "" }}">
                    <a href="{{ route("admin.templates.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.template.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('contact_access')
                <li class="{{ request()->is("admin/contacts") || request()->is("admin/contacts/*") ? "active" : "" }}">
                    <a href="{{ route("admin.contacts.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.contact.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('user_alert_access')
                <li class="{{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                    <a href="{{ route("admin.user-alerts.index") }}">
                        <i class="fa-fw fas fa-bell">

                        </i>
                        <span>{{ trans('cruds.userAlert.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('faq_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-question">

                        </i>
                        <span>{{ trans('cruds.faqManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('faq_category_access')
                            <li class="{{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.faq-categories.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.faqCategory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('faq_question_access')
                            <li class="{{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.faq-questions.index") }}">
                                    <i class="fa-fw fas fa-question">

                                    </i>
                                    <span>{{ trans('cruds.faqQuestion.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('testimonial_access')
                <li class="{{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "active" : "" }}">
                    <a href="{{ route("admin.testimonials.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.testimonial.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('review_access')
                <li class="{{ request()->is("admin/reviews") || request()->is("admin/reviews/*") ? "active" : "" }}">
                    <a href="{{ route("admin.reviews.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.review.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('slider_access')
                <li class="{{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "active" : "" }}">
                    <a href="{{ route("admin.sliders.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.slider.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('course_access')
                <li class="{{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "active" : "" }}">
                    <a href="{{ route("admin.courses.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.course.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('lesson_access')
                <li class="{{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "active" : "" }}">
                    <a href="{{ route("admin.lessons.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.lesson.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('test_access')
                <li class="{{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "active" : "" }}">
                    <a href="{{ route("admin.tests.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.test.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('question_access')
                <li class="{{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                    <a href="{{ route("admin.questions.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.question.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('question_option_access')
                <li class="{{ request()->is("admin/question-options") || request()->is("admin/question-options/*") ? "active" : "" }}">
                    <a href="{{ route("admin.question-options.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.questionOption.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('test_result_access')
                <li class="{{ request()->is("admin/test-results") || request()->is("admin/test-results/*") ? "active" : "" }}">
                    <a href="{{ route("admin.test-results.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.testResult.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('test_answer_access')
                <li class="{{ request()->is("admin/test-answers") || request()->is("admin/test-answers/*") ? "active" : "" }}">
                    <a href="{{ route("admin.test-answers.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.testAnswer.title') }}</span>

                    </a>
                </li>
            @endcan
            @php($unread = \App\Models\QaTopic::unreadCount())
                <li class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }}">
                    <a href="{{ route("admin.messenger.index") }}">
                        <i class="fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                            <strong>( {{ $unread }} )</strong>
                        @endif

                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                            <a href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key">
                                </i>
                                {{ trans('global.change_password') }}
                            </a>
                        </li>
                    @endcan
                @endif
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
        </ul>
    </section>
</aside>