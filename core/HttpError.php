<?php
class HttpError extends Exception
{
  public function __construct($code = 200, Exception $previous = null)
  {
    global $HTTP_MESSAGE;
    if (!isset($HTTP_MESSAGE[$code]))
      $code = 776;
    $message = $HTTP_MESSAGE[$code];

    parent::__construct($message, $code, $previous);
  }

  public function __toString()
  {
    return __CLASS__ . ': [' . $this->code . ']: ' . $this->message;
  }
}
?>