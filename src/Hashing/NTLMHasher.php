<?php

namespace Hsuan\LaravelHasherNTLM\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Hashing\AbstractHasher;
use Illuminate\Support\Str;

class NTLMHasher extends AbstractHasher implements HasherContract
{
    /**
     * Get information about the given hashed value.
     *
     * @param string $hashedValue
     * @return array
     */
    public function info($hashedValue): array
    {
        return [
            'algo' => 'NTLM',
            'algoName' => 'NTLM',
            'options' => [],
        ];
    }

    /**
     * Hash the given value.
     *
     * @param string $value
     * @param array $options
     * @return string
     */
    public function make(#[\SensitiveParameter] $value, array $options = [])
    {
        $utf16le = mb_convert_encoding($value, 'UTF-16LE');
        return Str::upper(bin2hex(hash('md4', $utf16le, true)));
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function check(#[\SensitiveParameter] $value, $hashedValue, array $options = []){
        return $this->make($value) === Str::upper($hashedValue);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
}
