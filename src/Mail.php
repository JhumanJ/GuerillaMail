<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/09/2019
 * Time: 13:15
 */

namespace JhumanJ\GuerillaMail;


/**
 * Represents an email received
 *
 * Class Mail
 * @package JhumanJ\GuerillaMail
 */
class Mail
{
    public $from;
    public $timestamp;
    public $date;
    public $replyTo;
    public $read;
    public $subject;
    public $excerpt;
    public $body;
    public $contentType;
    public $id;
    public $recipient;
    public $size;

    public function __construct( $data )
    {
        $this->from = $data['mail_from'];
        $this->timestamp = $data['mail_timestamp'];
        $this->replyTo = $data['reply_to'];
        $this->subject = $data['mail_subject'];
        $this->excerpt = $data['mail_excerpt'];
        $this->read = $data['mail_read'];
        $this->date = $data['mail_date'];
        $this->id = $data['mail_id'];
        $this->contentType = $data['content_type'];
        $this->recipient = $data['mail_recipient'];
        $this->body = $data['mail_body'];
        $this->size = $data['size'];
    }

    public static function fromResponse( $reponse )
    {
        return new self( $reponse );
    }

    public function __toString() {
        $string = 'ID: '.$this->id."\n";
        $string .= 'From: '.$this->from."\n";
        $string .= 'Recipient: '.$this->recipient."\n";
        $string .= 'Timestamp: '.$this->timestamp."\n";
        $string .= 'Reply To: '.$this->replyTo."\n";
        $string .= 'Date: '.$this->date."\n";
        $string .= 'Size: '.$this->size."\n";
        $string .= 'Content Type: '.$this->contentType."\n";
        $string .= 'Subject: '.$this->subject."\n";
        $string .= 'Excerpt: '.$this->excerpt."\n";
        $string .= 'Body: '.$this->body."\n";

        return $string;
    }
}