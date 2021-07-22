@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.faqCategory.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.faq-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $faqCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqCategory.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $faqCategory->category }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqCategory.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $faqCategory->slug }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.faq-categories.index') }}">
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
                        <a href="#category_faq_questions" aria-controls="category_faq_questions" role="tab" data-toggle="tab">
                            {{ trans('cruds.faqQuestion.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="category_faq_questions">
                        @includeIf('admin.faqCategories.relationships.categoryFaqQuestions', ['faqQuestions' => $faqCategory->categoryFaqQuestions])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection