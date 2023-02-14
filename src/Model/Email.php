<?php

declare(strict_types=1);

namespace Unione\Model;

/**
 * This class for collecting message parameters.
 */
class Email
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
     * @return Email
     */
    public function setRecipients(array $recipients): Email
    {
        $this->message['recipients'] = \array_map(function ($item) {
            return \is_array($item) ? $item : ['email' => $item];
        }, $recipients);

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
     * @return Email
     */
    public function setTemplateId(string $templateId): Email
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
     * @return Email
     */
    public function setTags(array $tags): Email
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
     * @return Email
     */
    public function setSkipUnsubscribe(int $skipUnsubscribe): Email
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
     * @return Email
     */
    public function setGlobalLanguage(string $globalLanguage): Email
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
     * @return Email
     */
    public function setTemplateEngine(string $templateEngine): Email
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
     * @return Email
     */
    public function setGlobalSubstitutions(array $globalSubstitutions): Email
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
     * @return Email
     */
    public function setGlobalMetadata(array $globalMetadata): Email
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
     * @return Email
     */
    public function setBody(array $body): Email
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
     * @return Email
     */
    public function setSubject(string $subject): Email
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
     * @return Email
     */
    public function setFromEmail(string $fromEmail): Email
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
     * @return Email
     */
    public function setFromName(string $fromName): Email
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
     * @return Email
     */
    public function setReplyTo(string $replyTo): Email
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
     * @return Email
     */
    public function setTrackLinks(int $trackLinks): Email
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
     * @return Email
     */
    public function setTrackRead(int $trackRead): Email
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
     * @return Email
     */
    public function setHeaders(array $headers): Email
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
     * @return Email
     */
    public function setAttachments(array $attachments): Email
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
     * @return Email
     */
    public function setInlineAttachments(array $inlineAttachments): Email
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
     * @return Email
     */
    public function setOptions(array $options): Email
    {
        $this->message['options'] = $options;

        return $this;
    }

    /**
     * @param string $platform
     *
     * @return Email
     */
    public function setPlatform(string $platform): Email
    {
        $this->message['platform'] = $platform;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->message['platform'];
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
     * @return Email
     */
    public static function fromArray($message): Email
    {
        $obj = new Email();
        $obj->message = $message;

        return $obj;
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return Email
     */
    public function set(string $property, $value): Email
    {
        $this->message[$property] = $value;

        return $this;
    }

    /**
     * @param array $requestHeaders
     *
     * @return Email
     */
    public function setRequestHeaders(array $requestHeaders): Email
    {
        $this->requestHeaders = $requestHeaders;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return Email
     */
    public function setRequestHeader(string $key, string $value): Email
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
