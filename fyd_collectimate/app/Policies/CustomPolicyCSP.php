<?php

namespace App\Policies;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Policy;

class CustomPolicyCSP extends Policy
{
    /** @var string */
    protected string $nonce = '';

    public function setNonce(string $nonce): static
    {
        $this->nonce = $nonce;
        Log::info("CSP nonce set to: {$nonce}");
        return $this;
    }

    public function configure(): void
    {
        // Base strict policy
        $this
            ->addDirective(Directive::SCRIPT, [
                Keyword::SELF,
                'https://unpkg.com',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',
            ])
            ->addDirective(Directive::SCRIPT_ELEM, [
                Keyword::SELF,
                'https://unpkg.com',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',
            ])
            ->addDirective(Directive::STYLE, [
                Keyword::SELF,
                'data:',
                'https://cdn.jsdelivr.net',
                'https://fonts.googleapis.com',
            ])
            ->addDirective(Directive::CONNECT, [
                Keyword::SELF,
                'https://unpkg.com',
                // 'ws://localhost:5173', // add in dev for HMR
            ])
            ->addDirective(Directive::IMG, [
                Keyword::SELF,
                'data:',
            ])
            ->addDirective(Directive::FONT, [
                Keyword::SELF,
                'https://fonts.gstatic.com',
                'https://fonts.bunny.net',
                'https://fonts.googleapis.com',
                'data:',
            ])
            ->addDirective(Directive::FORM_ACTION, [
                Keyword::SELF,
            ])
            ->addDirective(Directive::BASE, [
                Keyword::SELF,
            ])
            ->addNonceForDirective(Directive::SCRIPT)
            ->addNonceForDirective(Directive::SCRIPT_ELEM)
            ->addNonceForDirective(Directive::STYLE);

        // 👇 Relax CSP when debug mode is enabled
        if (Config::get('app.debug')) {
            $this
                ->addDirective(Directive::SCRIPT, [
                    Keyword::UNSAFE_INLINE,
                    Keyword::UNSAFE_EVAL,
                ])
                ->addDirective(Directive::SCRIPT_ELEM, [
                    Keyword::UNSAFE_INLINE,
                    Keyword::UNSAFE_EVAL,
                ])
                ->addDirective(Directive::STYLE, [
                    Keyword::UNSAFE_INLINE,
                ]);
        }
    }
}
