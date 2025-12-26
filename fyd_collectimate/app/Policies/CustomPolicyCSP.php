<?php

namespace App\Policies;

use Illuminate\Support\Facades\Log;  // <--- Add this
use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Policy;

class CustomPolicyCSP extends Policy
{
    /** @var string */
    protected string $nonce = '';

    /**
     * Automatically called by Spatie CSP middleware when nonce is generated.
     */
    public function setNonce(string $nonce): static
    {
        $this->nonce = $nonce;
        Log::info("CSP nonce set to: {$nonce}");
        return $this;
    }

    public function configure(): void
    {
        $this
           ->addDirective(Directive::SCRIPT, [
                Keyword::SELF,
                'nonce-'.$this->nonce,
                'https://unpkg.com',
                'https://www.google.com',
                'https://www.gstatic.com',
                'https://cdn.jsdelivr.net',
                Keyword::UNSAFE_INLINE,  // <-- add this
            ])

            ->addDirective(Directive::STYLE, [
                Keyword::SELF,
                'data:',
                "nonce-{$this->nonce}",
                Keyword::UNSAFE_INLINE, // Allow inline styles
                'https://cdn.jsdelivr.net',
            ])

            ->addDirective(Directive::CONNECT, [
                Keyword::SELF,
                'https://unpkg.com',
            ])
            ->addDirective(Directive::IMG, [
                Keyword::SELF,
                'data:',
            ])
            ->addDirective(Directive::FONT, [
                Keyword::SELF,
                'https://fonts.gstatic.com',
                'https://cdn.example.com',
                'https://fonts.bunny.net',   // <-- Add this line
                'data:',
            ])


            ->addDirective(Directive::FORM_ACTION, [
                Keyword::SELF,
            ])
            ->addDirective(Directive::BASE, [
                Keyword::SELF,
            ]);
    }
}
