<?php

namespace App\Traits;

trait Response
{
    public static $OK = 200;
    public static $CREATED = 201;
    public static $ACCEPTED = 202;
    public static $NO_CONTENT = 204;
    public static $NOT_MODIFIED = 304;
    public static $BAD_REQUEST = 400;
    public static $UNAUTHORIZED = 401;
    public static $FORBIDDEN = 403;
    public static $NOT_FOUND = 404;
    public static $UNSUPPORTED_ACTION = 405;
    public static $VALIDATION_FAILED = 422;
    public static $SERVER_ERROR = 500;
    public static $MOVED_PERMANENTLY = 301;

    public function errorResponse($errors = null, $message = null, $code = null, $data = null)
    {
        $code = is_null($code) ? self::$VALIDATION_FAILED : $code;
        return $this->response($data, $errors, $message, $code);
    }

    public function response($data = null, $errors = null, $message = null, $code = 200)
    {
        if (is_null($message))
            $message = $this->status($code) ? trans('messages.success') : trans('messages.error');

        return response()->json($this->jsonFormat(
            $this->getData($data),
            $errors,
            $message,
            $code),
            $code
        );
    }

    public function deleteResponse($response)
    {
        $message = $response ? trans('messages.success_delete') : trans('messages.error_delete');
        return $this->response(
            null,
            null,
            $message,
            $this->checkDeleteResponse($response)
        );
    }

    public function unauthorizedResponse($message = null)
    {
        if (is_null($message))
            $message = trans('messages.unauthorized');
        return $this->response(
            null,
            null,
            $message,
            self::$FORBIDDEN
        );
    }

    public function successResponse($data, $message = null)
    {
        $code = $this->getCode($data);

        if (is_null($message))
            $message = $this->status($code) ? trans('messages.success') : trans('messages.error');

        return $this->response(
            null,
            null,
            $message,
            $code
        );
    }

    public function redirectResponse($data)
    {

        return $this->response(
            $data,
            null,
            null,
            self::$MOVED_PERMANENTLY
        );
    }

    private function getData($data)
    {
        return $data;
    }

    private function jsonFormat($data, $errors, $message, $code)
    {
        return [
            'status' => $this->status($code),
            'message' => $this->message($code, $message),
            'errors' => $this->errors($errors),
            'data' => $this->data($data, $code)
        ];
    }

    private function errors($errors)
    {
        return $errors;
    }

    private function status($code)
    {
        return in_array($code, $this->successCode()) ? true : false;
    }

    private function successCode()
    {
        return [
            self::$OK,
            self::$CREATED,
            self::$ACCEPTED,
            self::$NO_CONTENT,
            self::$MOVED_PERMANENTLY
        ];
    }

    private function message($code, $message)
    {
        switch ($code) {
            case  self::$OK:
                return !$message ? trans('messages.OK') : $message;
            case self::$CREATED:
                return !$message ? trans('messages.Created') : $message;
            case self::$ACCEPTED:
                return !$message ? trans('messages.Accepted') : $message;
            case self::$NO_CONTENT:
                return !$message ? trans('messages.NO_CONTENT') : $message;
            case self::$NOT_MODIFIED:
                return !$message ? trans('messages.Not_Modified') : $message;
            case self::$BAD_REQUEST:
                return !$message ? trans('messages.Unsupported_Action') : $message;
            case self::$UNAUTHORIZED:
                return !$message ? trans('messages.Unauthorized') : $message;
            case self::$FORBIDDEN:
                return !$message ? trans('messages.Forbidden') : $message;
            case self::$NOT_FOUND:
                return !$message ? trans('messages.Not_Found') : $message;
            case self::$UNSUPPORTED_ACTION:
                return !$message ? trans('messages.Method_Not_Allowed') : $message;
            case self::$VALIDATION_FAILED:
                return !$message ? trans('messages.Unprocessable_Entity') : $message;
            case self::$SERVER_ERROR:
                return !$message ? trans('messages.Internal_Server_Error') : $message;
            default :
                return $message;
        }
    }

    private function data($response, $code = null)
    {
        if (!is_object($response) && !is_array($response))
            return null;

        return $response;
    }

    private function getCode($data)
    {
        return $data ? self::$OK : self::$VALIDATION_FAILED;
    }

    private function checkDeleteResponse($response)
    {
        return $response ? self::$OK : self::$BAD_REQUEST;
    }
}
