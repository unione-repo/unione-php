<?php

declare(strict_types=1);

namespace Unione;

/**
 * This class for collecting message parameters.
 */
class UniOneEmail
{
    /**
     * Array with all parameters.
     *
     * @var array
     */
    private array $message = [];

    /**
     * Array with request headers.
     *
     * @var array
     */
    private array $requestHeaders = [];

    /**
     * @param array $recipients
     * @param array $body
     */
    public function __construct(array $recipients = [], array $body = [])
    {
        $this->setRecipients($recipients);
        $this->setBody($body);
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->message['recipients'];
    }

    /**
     * @param array $recipients
     *
     * @return UniOneEmail
     */
    public function setRecipients(array $recipients): UniOneEmail
    {
        foreach ($recipients as $item) {
            if (!is_array($item)) {
                $new_array[]['email'] = $item;
            }
        }

        $this->message['recipients'] = $new_array ?? $recipients;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateId(): string
    {
        return $this->message['template_id'];
    }

    /**
     * @param string $templateId
     *
     * @return UniOneEmail
     */
    public function setTemplateId(string $templateId): UniOneEmail
    {
        $this->message['template_id'] = $templateId;

        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->message['tags'];
    }

    /**
     * @param array $tags
     *
     * @return UniOneEmail
     */
    public function setTags(array $tags): UniOneEmail
    {
        $this->message['tags'] = $tags;

        return $this;
    }

    /**
     * @return int
     */
    public function getSkipUnsubscribe(): int
    {
        return $this->message['skip_unsubscribe'];
    }

    /**
     * @param int $skipUnsubscribe
     *
     * @return UniOneEmail
     */
    public function setSkipUnsubscribe(int $skipUnsubscribe): UniOneEmail
    {
        $this->message['skip_unsubscribe'] = $skipUnsubscribe;

        return $this;
    }

    /**
     * @return string
     */
    public function getGlobalLanguage(): string
    {
        return $this->message['global_language'];
    }

    /**
     * @param string $globalLanguage
     *
     * @return UniOneEmail
     */
    public function setGlobalLanguage(string $globalLanguage): UniOneEmail
    {
        $this->message['global_language'] = $globalLanguage;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateEngine(): string
    {
        return $this->message['template_engine'];
    }

    /**
     * @param string $templateEngine
     *
     * @return UniOneEmail
     */
    public function setTemplateEngine(string $templateEngine): UniOneEmail
    {
        $this->message['template_engine'] = $templateEngine;

        return $this;
    }

    /**
     * @return array
     */
    public function getGlobalSubstitutions(): array
    {
        return $this->message['global_substitutions'];
    }

    /**
     * @param array $globalSubstitutions
     *
     * @return UniOneEmail
     */
    public function setGlobalSubstitutions(array $globalSubstitutions): UniOneEmail
    {
        $this->message['global_substitutions'] = $globalSubstitutions;

        return $this;
    }

    /**
     * @return array
     */
    public function getGlobalMetadata(): array
    {
        return $this->message['global_metadata'];
    }

    /**
     * @param array $globalMetadata
     *
     * @return UniOneEmail
     */
    public function setGlobalMetadata(array $globalMetadata): UniOneEmail
    {
        $this->message['global_metadata'] = $globalMetadata;

        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->message['body'];
    }

    /**
     * @param array $body
     *
     * @return UniOneEmail
     */
    public function setBody(array $body): UniOneEmail
    {
        $this->message['body'] = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->message['subject'];
    }

    /**
     * @param string $subject
     *
     * @return UniOneEmail
     */
    public function setSubject(string $subject): UniOneEmail
    {
        $this->message['subject'] = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromEmail(): string
    {
        return $this->message['from_email'];
    }

    /**
     * @param string $fromEmail
     *
     * @return UniOneEmail
     */
    public function setFromEmail(string $fromEmail): UniOneEmail
    {
        $this->message['from_email'] = $fromEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->message['from_name'];
    }

    /**
     * @param string $fromName
     *
     * @return UniOneEmail
     */
    public function setFromName(string $fromName): UniOneEmail
    {
        $this->message['from_name'] = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplyTo(): string
    {
        return $this->message['reply_to'];
    }

    /**
     * @param string $replyTo
     *
     * @return UniOneEmail
     */
    public function setReplyTo(string $replyTo): UniOneEmail
    {
        $this->message['reply_to'] = $replyTo;

        return $this;
    }

    /**
     * @return int
     */
    public function getTrackLinks(): int
    {
        return $this->message['track_links'];
    }

    /**
     * @param int $trackLinks
     *
     * @return UniOneEmail
     */
    public function setTrackLinks(int $trackLinks): UniOneEmail
    {
        $this->message['track_links'] = $trackLinks;

        return $this;
    }

    /**
     * @return int
     */
    public function getTrackRead(): int
    {
        return $this->message['track_read'];
    }

    /**
     * @param int $trackRead
     *
     * @return UniOneEmail
     */
    public function setTrackRead(int $trackRead): UniOneEmail
    {
        $this->message['track_read'] = $trackRead;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->message['headers'];
    }

    /**
     * @param array $headers
     *
     * @return UniOneEmail
     */
    public function setHeaders(array $headers): UniOneEmail
    {
        $this->message['headers'] = $headers;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->message['attachments'];
    }

    /**
     * @param array $attachments
     *
     * @return UniOneEmail
     */
    public function setAttachments(array $attachments): UniOneEmail
    {
        $this->message['attachments'] = $attachments;

        return $this;
    }

    /**
     * @return array
     */
    public function getInlineAttachments(): array
    {
        return $this->message['inline_attachments'];
    }

    /**
     * @param array $inlineAttachments
     *
     * @return UniOneEmail
     */
    public function setInlineAttachments(array $inlineAttachments): UniOneEmail
    {
        $this->message['inline_attachments'] = $inlineAttachments;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->message['options'];
    }

    /**
     * @param array $options
     *
     * @return UniOneEmail
     */
    public function setOptions(array $options): UniOneEmail
    {
        $this->message['options'] = $options;

        return $this;
    }

    /**
     * Method for build message array.
     *
     * @return array[]
     */
    public function toArray(): array
    {
        return ['message' => $this->message];
    }

    /**
     * @param $message
     *
     * @return UniOneEmail
     */
    public static function fromArray($message): UniOneEmail
    {
        $obj = new UniOneEmail();
        $obj->message = $message;

        return $obj;
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return UniOneEmail
     */
    public function set(string $property, $value): UniOneEmail
    {
        $this->message[$property] = $value;

        return $this;
    }

    /**
     * @param array $requestHeaders
     *
     * @return UniOneEmail
     */
    public function setRequestHeaders(array $requestHeaders): UniOneEmail
    {
        $this->requestHeaders = $requestHeaders;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return UniOneEmail
     */
    public function setRequestHeader(string $key, string $value): UniOneEmail
    {
        $this->requestHeaders[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array
    {
        return $this->requestHeaders;
    }
}
