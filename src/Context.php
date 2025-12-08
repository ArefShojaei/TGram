<?php

namespace TGram;

use TGram\DTO\Update;


/**
 * @method object sendMessage(string $text, array $options = [])
 * @method object replyMessage(string $text, array $options = [])
 *
 * @method object sendPhoto(string $src, string $caption = "", array $options = [])
 * @method object replyPhoto(string $src, string $caption = "", array $options = [])
 *
 * @method object sendLocation(float $lat, float $lon, array $options = [])
 * @method object replyLocation(float $lat, float $lon, array $options = [])
 *
 * @method object sendContact(string $phone, string $firstName, array $options = [])
 * @method object replyContact(string $phone, string $firstName, array $options = [])
 *
 * @method object sendAudio(string $src, string $caption = "", array $options = [])
 * @method object replyAudio(string $src, string $caption = "", array $options = [])
 */
final class Context
{
    private const ENTITIES_NAMESPACE = __NAMESPACE__ . "\\Entities\\";

    public function __construct(
        private readonly Update $update,
        private Bot $bot,
    ) {}

    public function __call($method, $params)
    {
        $methodPreifxes = ["reply", "send"];

        if (str_starts_with($method, current($methodPreifxes))) {
            $entity = $this->getEntity($method, current($methodPreifxes));

            $instance = new $entity($this->update, $this->bot, ...$params);

            return $instance->reply();
        }

        if (str_starts_with($method, end($methodPreifxes))) {
            $entity = $this->getEntity($method, end($methodPreifxes));

            $instance = new $entity($this->update, $this->bot, ...$params);

            return $instance->send();
        }
    }

    private function getEntity(string $method, string $methodPrefix): string {
        $methodParts = explode($methodPrefix, $method);

        $entity = end($methodParts);

        return self::ENTITIES_NAMESPACE . ucfirst($entity);
    }
}
