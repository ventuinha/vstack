<?php

use marcusvbda\vstack\Controllers\{
	VstackController,
	ResourceController
};

Route::group(['prefix' => "vstack"], function () {
	Route::group(['middleware' => ['web', 'auth']], function () {
		Route::post('{resource}/get-partial-content', [VstackController::class, 'getPartialContent'])->name("vstack.get_partials_content");
	});
});

Route::group(['prefix' => "admin"], function () {
	Route::group(['middleware' => ['web', 'auth']], function () {
		Route::post('upload', [ResourceController::class, 'upload'])->name("resource.upload");
		Route::get('{resource}', [ResourceController::class, 'index'])->name("resource.index");



		Route::post('{resource}/field-data', [ResourceController::class, 'fieldData'])->name("resource.fielddata");
		Route::get('{resource}/create', [ResourceController::class, 'create'])->name("resource.create");
		Route::post('{resource}/store', [ResourceController::class, 'store'])->name("resource.store");
		Route::post('{resource}/field/store', [ResourceController::class, 'storeField'])->name("resource.field.store");
		Route::get('{resource}/import', [ResourceController::class, 'import'])->name("resource.import");
		Route::post('{resource}/export', [ResourceController::class, 'export'])->name("resource.export");
		Route::get('{resource}/export_download/{file}', [ResourceController::class, 'exportDownload'])->name("resource.export_download");
		Route::get('{resource}/import/sheet_template', [ResourceController::class, 'importSheetTemplate'])->name("resource.import.check_file");
		Route::post('{resource}/import/check_file', [ResourceController::class, 'checkFileImport'])->name("resource.import.check_file");
		Route::post('{resource}/import/submit', [ResourceController::class, 'importSubmit'])->name("resource.import.submit");

		Route::get('{resource}/{code}', [ResourceController::class, 'view'])->middleware(['hashids:code'])->name("resource.view");

		Route::get('{resource}/tags/options', [ResourceController::class, 'tagOptions'])->name("resource.optionTags");
		Route::get('{resource}/{code}/tags', [ResourceController::class, 'getTags'])->middleware(['hashids:code'])->name("resource.getTags");
		Route::delete('{resource}/{code}/tags/destroy/{id}', [ResourceController::class, 'destroyTag'])->middleware(['hashids:code'])->name("resource.deleteTag");
		Route::post('{resource}/{code}/tags/add', [ResourceController::class, 'addTag'])->middleware(['hashids:code'])->name("resource.addTag");


		Route::get('{resource}/{code}/edit', [ResourceController::class, 'edit'])->middleware(['hashids:code'])->name("resource.edit");
		Route::delete('{resource}/{code}/destroy', [ResourceController::class, 'destroy'])->middleware(['hashids:code'])->name("resource.destroy");
		Route::delete('{resource}/{id}/field/destroy', [ResourceController::class, 'destroyField'])->name("resource.field.destroy");
		Route::post('inputs/option_list', [ResourceController::class, 'option_list'])->name("resource.inputs.option_list");
		Route::post('globalsearch', [ResourceController::class, 'globalSearch'])->name("resource.globalsearch");
		Route::post('{resource}/metric-calculate/{key}', [ResourceController::class, 'metricCalculate'])->name("resource.metricCalculate");
	});
});
