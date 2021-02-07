<?php
	
	namespace App\Support;
	
	use Illuminate\Contracts\Pagination\LengthAwarePaginator;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Response;
	
	trait JsonResponseTrait
	{
		private int $STATUS_CODE = 200;
		private array $PAGINATION, $META;
		private string $MESSAGE = '';
		
		public function setStatusCode(int $code)
		{
			$this->STATUS_CODE = $code;
			
			return $this;
		}
		
		public function setMessage(string $message)
		{
			$this->MESSAGE = $message;
			
			return $this;
		}
		
		public function setMeta(array $meta)
		{
			$this->META = $meta;
			
			return $this;
		}
		
		public function setPagination(LengthAwarePaginator $pagination)
		{
			$this->PAGINATION = [
				'total' => $pagination->total(),
				'per_page' => min($pagination->total(), $pagination->perPage()),
				'current_page' => $pagination->currentPage(),
				'last_page' => $pagination->lastPage(),
				'first_page_url' => $pagination->url(1),
				'last_page_url' => $pagination->url($pagination->lastPage()),
				'next_page_url' => $pagination->nextPageUrl(),
				'prev_page_url' => $pagination->previousPageUrl(),
				'path' => url('v1'),
				'from' => $pagination->firstItem(),
				'to' => $pagination->lastItem(),
			];
			
			return $this;
		}
		
		public function respond($data = [], array $headers = []): JsonResponse
		{
			$responseData = [];
			
			if ($data) {
				$responseData['data'] = $data;
			}

//        if (!empty($this->META)) {
//            $responseData['meta'] = $this->META;
//        }
			
			if (!empty($this->PAGINATION)) {
				$responseData['pagination'] = $this->PAGINATION;
			}
			
			if ($this->MESSAGE) {
				$responseData['message'] = $this->MESSAGE;
			}
			
			if (!empty($this->META)) {
				foreach ($this->META as $key => $value) {
					$responseData[$key] = $value;
				}
			}
			
			return response()->json($responseData, $this->STATUS_CODE, $headers);
		}
		
		
		public function ok($data = null): JsonResponse
		{
			if (!$this->MESSAGE) {
				$this->MESSAGE = 'Operation carried out successfully!';
			}
			
			return $this->setStatusCode(Response::HTTP_OK)->respond($data);
		}
		
		public function created($data): JsonResponse
		{
			if (!$this->MESSAGE) {
				$this->MESSAGE = 'Created successfully';
			}
			
			return $this->setStatusCode(Response::HTTP_CREATED)->respond($data);
		}
		
		public function unauthorized($message = 'You are not authorized to perform this action')
		{
			return $this->setMessage($message)->setStatusCode(Response::HTTP_UNAUTHORIZED)->respond([]);
		}
		
		
		public function updated($data): JsonResponse
		{
			if (!$this->MESSAGE) {
				$this->MESSAGE = 'Updated successfully';
			}
			
			return $this->setStatusCode(Response::HTTP_CREATED)->respond($data);
		}
		
		public function deleted($data = []): JsonResponse
		{
			if (!$this->MESSAGE) {
				$this->MESSAGE = 'Deleted successfully';
			}
			
			return $this->setStatusCode(Response::HTTP_OK)->respond($data);
		}
		
		public function invalidRequest($message = "Invalid Request"){
			
			return $this->setMessage($message)->setStatusCode(Response::HTTP_BAD_REQUEST)->respond([]);
			
		}
	}
