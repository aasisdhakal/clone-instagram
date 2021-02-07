<?php
	
	namespace App\Exceptions;
	
	use App\Support\JsonResponseTrait;
	use Lanin\Laravel\ApiExceptions\NotFoundApiException;
	use Lanin\Laravel\ApiExceptions\ValidationFailedApiException;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
	use Throwable;
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	use Lanin\Laravel\ApiExceptions\ApiException;
	use Lanin\Laravel\ApiExceptions\LaravelExceptionHandler;
	
	class Handler extends LaravelExceptionHandler
	{
		use JsonResponseTrait;
		public function render($request, Throwable $exception)
		{
			switch(true) {
				case $exception instanceof ModelNotFoundException:
					$exception = new CustomModelNotFoundException($exception);
					break;
				case $exception instanceof NotFoundHttpException:
					$exception = new NotFoundApiException('Unable to resolve request to provided url!');
					break;
				case $exception instanceof \Error:
					throw new \Exception($exception);
				default:
					$exception = $this->resolveException($exception);
			}
			
			$response = response()->json($this->formatApiResponse($exception), $exception->getCode(), $exception->getHeaders());
			
			return $response->withException($exception);
		}
		
		protected function formatApiResponse(ApiException $exception)
		{
			if($exception instanceof ValidationFailedApiException) {
				$exception = $exception->toArray();
				$exception['errors'] = $exception['meta']['errors'];
				unset($exception['meta']);
				return $exception;
			}
			return $exception->toArray();
		}
		
	}
