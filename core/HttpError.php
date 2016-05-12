<?php
  class HttpError extends Exception {
    public function __construct($code = 200, Exception $previous = null) {
      $HTTP_MESSAGE = array(
        // Informational
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        
        // Success
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        
        // Redirect
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        
        // Client error
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        
        // Server error
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
        
        // Developer error
        // ...inexcusable
        701 => 'Meh',
        702 => 'Emacs',
        703 => 'Explosion',
        704 => 'Goto Fail',
        705 => 'I wrote the code and missed the necessary validation by an oversight',
        // ...novelty implementation
        710 => 'PHP',
        711 => 'Convenience Store',
        712 => 'NoSQL',
        718 => 'Haskell',
        719 => 'I am not a teapot',
        // ...edge cases
        720 => 'Unpossible',
        721 => 'Known Unknowns',
        722 => 'Unknown Unknowns',
        723 => 'Tricky',
        724 => 'This line should be unreachable',
        725 => 'It works on my machine',
        726 => 'It\'s a feature, not a bug',
        727 => '32 bits is plenty',
        // ...fucking
        730 => 'Fucking Bower',
        731 => 'Fucking Rubygems',
        732 => 'Fucking Unic💩de',
        733 => 'Fucking Deadlocks',
        734 => 'Fucking Deferreds',
        735 => 'Fucking IE',
        736 => 'Fucking Race Conditions',
        737 => 'FuckThreadsing',
        738 => 'Fucking Bundler',
        739 => 'Fucking Windows',
        // ...meme driven
        740 => 'Computer says no',
        741 => 'Compiling',
        742 => 'A kitten dies',
        743 => 'I thought I knew regular expressions',
        744 => 'Y U NO write integration tests?',
        745 => 'I don\'t always test my code, but when I do I do it in production',
        746 => 'Missed Ballmer Peak',
        747 => 'Motherfucking Snakes on the Motherfucking Plane',
        748 => 'Confounded by Ponies',
        749 => 'Reserved for Chuck Norris',
        // ...syntax
        750 => 'Didn\'t bother to compile it',
        753 => 'Syntax Error',
        754 => 'Too many semi-colons',
        755 => 'Not enough semi-colons',
        756 => 'Insufficiently polite',
        757 => 'Excessively polite',
        759 => 'Unexpected T_PAAMAYIM_NEKUDOTAYIM',
        // ...substance-affected
        761 => 'Hungover',
        762 => 'Stoned',
        763 => 'Under-Caffeinated',
        764 => 'Over-Caffeinated',
        765 => 'Railscamp',
        766 => 'Sober',
        767 => 'Drunk',
        768 => 'Accidentally Took Sleeping Pills Instead Of Migraine Pills During Crunch Week',
        769 => 'Questionable Maturity Level',
        // ...predictable
        771 => 'Cached for too long',
        772 => 'Not cached long enough',
        773 => 'Not cached at all',
        774 => 'Why was this cached?',
        775 => 'Out of cash',
        776 => 'Error on the Exception',
        777 => 'Coincidence',
        778 => 'Off By One Error',
        779 => 'Off By Too Many To Count Error',
        // ...somebody else's problem
        780 => 'Project owner not responding',
        781 => 'Operations',
        782 => 'QA',
        783 => 'It was a customer request, honestly',
        784 => 'Management, obviously',
        785 => 'TPS Cover Sheet not attached',
        786 => 'Try it now',
        787 => 'Further Funding Required',
        788 => 'Designer\'s final designs weren\'t',
        789 => 'Not my department',
        // ...Internet crashed
        791 => 'The Internet shut down due to copyright restrictions',
        792 => 'Climate change driven catastrophic weather event',
        793 => 'Zombie Apocalypse',
        794 => 'Someone let PG near a REPL',
        795 => '#heartbleed',
        797 => 'This is the last page of the Internet. Go back',
        799 => 'End of the world'
      );
      
      if(!isset($HTTP_MESSAGE[$code])) $code = 776;
      $message = $HTTP_MESSAGE[$code];
    
      parent::__construct($message, $code, $previous);
    }

    public function __toString() {
      return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
  }
?>