@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.two_factor') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.approved') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.verified') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $user->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $user->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.username') }}
                                    </th>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.gender') }}
                                    </th>
                                    <td>
                                        {{ App\Models\User::GENDER_RADIO[$user->gender] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.is_featured') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->is_featured ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.credits') }}
                                    </th>
                                    <td>
                                        {{ $user->credits }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\User::STATUS_SELECT[$user->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.picture_image') }}
                                    </th>
                                    <td>
                                        @if($user->picture_image)
                                            <a href="{{ $user->picture_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->picture_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.gallery_images') }}
                                    </th>
                                    <td>
                                        @foreach($user->gallery_images as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $user->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.state') }}
                                    </th>
                                    <td>
                                        {{ $user->state->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $user->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $user->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.pin_code') }}
                                    </th>
                                    <td>
                                        {{ $user->pin_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.qualification') }}
                                    </th>
                                    <td>
                                        {{ $user->qualification }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.exprience') }}
                                    </th>
                                    <td>
                                        {{ $user->exprience }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id_proof') }}
                                    </th>
                                    <td>
                                        @foreach($user->id_proof as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.about_us') }}
                                    </th>
                                    <td>
                                        {{ $user->about_us }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.updated_at') }}
                                    </th>
                                    <td>
                                        {{ $user->updated_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.deleted_at') }}
                                    </th>
                                    <td>
                                        {{ $user->deleted_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#created_by_templates" aria-controls="created_by_templates" role="tab" data-toggle="tab">
                            {{ trans('cruds.template.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_pages" aria-controls="created_by_pages" role="tab" data-toggle="tab">
                            {{ trans('cruds.page.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_product_categories" aria-controls="created_by_product_categories" role="tab" data-toggle="tab">
                            {{ trans('cruds.productCategory.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_product_tags" aria-controls="created_by_product_tags" role="tab" data-toggle="tab">
                            {{ trans('cruds.productTag.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_products" aria-controls="created_by_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.product.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_careers" aria-controls="created_by_careers" role="tab" data-toggle="tab">
                            {{ trans('cruds.career.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_property_features" aria-controls="created_by_property_features" role="tab" data-toggle="tab">
                            {{ trans('cruds.propertyFeature.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_investors" aria-controls="created_by_investors" role="tab" data-toggle="tab">
                            {{ trans('cruds.investor.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_projects" aria-controls="created_by_projects" role="tab" data-toggle="tab">
                            {{ trans('cruds.project.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_properties" aria-controls="created_by_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#author_properties" aria-controls="author_properties" role="tab" data-toggle="tab">
                            {{ trans('cruds.property.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_blogs" aria-controls="created_by_blogs" role="tab" data-toggle="tab">
                            {{ trans('cruds.blog.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_packages" aria-controls="created_by_packages" role="tab" data-toggle="tab">
                            {{ trans('cruds.package.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_contacts" aria-controls="created_by_contacts" role="tab" data-toggle="tab">
                            {{ trans('cruds.contact.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_faq_categories" aria-controls="created_by_faq_categories" role="tab" data-toggle="tab">
                            {{ trans('cruds.faqCategory.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_faq_questions" aria-controls="created_by_faq_questions" role="tab" data-toggle="tab">
                            {{ trans('cruds.faqQuestion.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#created_by_reviews" aria-controls="created_by_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.review.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_link_reviews" aria-controls="user_link_reviews" role="tab" data-toggle="tab">
                            {{ trans('cruds.review.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_user_alerts" aria-controls="user_user_alerts" role="tab" data-toggle="tab">
                            {{ trans('cruds.userAlert.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="created_by_templates">
                        @includeIf('admin.users.relationships.createdByTemplates', ['templates' => $user->createdByTemplates])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_pages">
                        @includeIf('admin.users.relationships.createdByPages', ['pages' => $user->createdByPages])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_product_categories">
                        @includeIf('admin.users.relationships.createdByProductCategories', ['productCategories' => $user->createdByProductCategories])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_product_tags">
                        @includeIf('admin.users.relationships.createdByProductTags', ['productTags' => $user->createdByProductTags])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_products">
                        @includeIf('admin.users.relationships.createdByProducts', ['products' => $user->createdByProducts])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_careers">
                        @includeIf('admin.users.relationships.createdByCareers', ['careers' => $user->createdByCareers])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_property_features">
                        @includeIf('admin.users.relationships.createdByPropertyFeatures', ['propertyFeatures' => $user->createdByPropertyFeatures])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_investors">
                        @includeIf('admin.users.relationships.createdByInvestors', ['investors' => $user->createdByInvestors])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_projects">
                        @includeIf('admin.users.relationships.createdByProjects', ['projects' => $user->createdByProjects])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_properties">
                        @includeIf('admin.users.relationships.createdByProperties', ['properties' => $user->createdByProperties])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="author_properties">
                        @includeIf('admin.users.relationships.authorProperties', ['properties' => $user->authorProperties])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_blogs">
                        @includeIf('admin.users.relationships.createdByBlogs', ['blogs' => $user->createdByBlogs])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_packages">
                        @includeIf('admin.users.relationships.createdByPackages', ['packages' => $user->createdByPackages])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_contacts">
                        @includeIf('admin.users.relationships.createdByContacts', ['contacts' => $user->createdByContacts])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_faq_categories">
                        @includeIf('admin.users.relationships.createdByFaqCategories', ['faqCategories' => $user->createdByFaqCategories])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_faq_questions">
                        @includeIf('admin.users.relationships.createdByFaqQuestions', ['faqQuestions' => $user->createdByFaqQuestions])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="created_by_reviews">
                        @includeIf('admin.users.relationships.createdByReviews', ['reviews' => $user->createdByReviews])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_link_reviews">
                        @includeIf('admin.users.relationships.userLinkReviews', ['reviews' => $user->userLinkReviews])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_user_alerts">
                        @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection