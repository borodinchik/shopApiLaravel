<?php
namespace App\Exceptions;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

trait ExceptionTrait
{
    public function apiResponseException($request, $exception)
    {
        switch ($exception) {
            case $this->isModel($exception):
                return $this->modelResponse($exception);

            case $this->isHttp($exception):
                return $this->httpResponse($exception);

            case $this->isTokenJWT($exception):
                return $this->JWTResponse($exception);

            case $this->isTokenInvalid($exception):
                return $this->TokenInvalidResponse($exception);

            case $this->isTokenExpired($exception):
                return $this->TokenExpiredResponse($exception);
        }
        return parent::render($request, $exception);
    }

/*Exception function*/
    protected function isModel($exception)
    {
        return $exception instanceof ModelNotFoundException;
    }

    protected function isHttp($exception)
    {
        return $exception instanceof NotFoundHttpException;
    }

    protected function isTokenInvalid($exception)
    {
        return $exception instanceof TokenInvalidException;
    }

    protected function isTokenExpired($exception)
    {
        return $exception instanceof TokenExpiredException;
    }

    protected function isTokenJWT($exception)
    {
        return $exception instanceof JWTException;
    }

   /*Response Function*/
    protected function modelResponse($exception)
    {
        return response()->json([
            'error' => 'Task Model not found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse($exception)
    {
        return response()->json([
            'error' => 'Incorrect route'
        ],Response::HTTP_NOT_FOUND);
    }

    protected function TokenInvalidResponse($exception)
    {
        return response()->json([
            'error' => 'Token is Invalid'
        ], Response::HTTP_BAD_REQUEST);
    }

    protected function TokenExpiredResponse($exception)
    {
        return response()->json([
            'error' => 'Token is Expired'
        ], Response::HTTP_BAD_REQUEST);
    }

    protected function JWTResponse($exception)
    {
        return response()->json([
            'error' => 'There is problem with your token'
        ], Response::HTTP_BAD_REQUEST);
    }
}