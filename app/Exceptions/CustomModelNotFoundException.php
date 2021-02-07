<?php
	
namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lanin\Laravel\ApiExceptions\ApiException;
use Lanin\Laravel\ApiExceptions\Contracts\DontReport;

class CustomModelNotFoundException extends ApiException implements DontReport
{
	/**
	 * @param ModelNotFoundException $exception
	 */
	public function __construct(ModelNotFoundException $exception)
	{
		$model = $exception->getModel();
		$model = class_basename($model);
		$ids = $exception->getIds();
		if(app()->environment('production')) {
			$message = "Unable to find specific $model";
		} else {
			$exception->setModel($model, $ids);
			$message = $exception->getMessage();
		}
		
		parent::__construct(404, 'not_found', $message, $exception->getPrevious());
	}
}
