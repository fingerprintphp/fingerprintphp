<?php

namespace Fingerprintphp;

class FingerprintData implements \JsonSerializable
{
    protected ?string $visitorId;
    protected ?string $requestId;
    protected ?float $confidence;
    protected ?string $applePay;
    protected ?string $architecture;
    protected ?string $audio;
    protected ?string $audioBaseLatency;
    protected ?string $canvas;
    protected ?int $colorDepth;
    protected ?string $colorGamut;
    protected ?string $contrast;
    protected ?bool $cookiesEnabled;
    protected ?string $cpuClass;
    protected ?string $dateTimeLocale;
    protected ?int $deviceMemory;
    protected ?array $domBlockers;
    protected ?array $fontPreferences;
    protected ?array $fonts;
    protected ?bool $forcedColors;
    protected ?int $hardwareConcurrency;
    protected ?bool $hdr;
    protected ?bool $indexedDb;
    protected ?bool $invertedColors;
    protected ?array $languages;
    protected ?bool $localStorage;
    protected ?string $math;
    protected ?int $monochrome;
    protected ?bool $openDatabase;
    protected ?string $osCpu;
    protected ?bool $pdfViewerEnabled;
    protected ?string $platform;
    protected ?array $plugins;
    protected ?bool $privateClickMeasurement;
    protected ?bool $reducedMotion;
    protected ?bool $reducedTransparency;
    protected ?array $screenFrame;
    protected ?array $screenResolution;
    protected ?bool $sessionStorage;
    protected ?string $timezone;
    protected ?array $touchSupport;
    protected ?array $userAgentData;
    protected ?string $vendor;
    protected ?array $vendorFlavors;
    protected ?string $webgl;
    protected ?string $ip;
    protected ?string $userAgent;
    protected ?int $createdAt;

    public function __construct(array $data = [])
    {
        $this->visitorId = $data['visitorId'] ?? null;
        $this->requestId = $data['requestId'] ?? null;
        $this->confidence = $data['confidence'] ?? null;
        $this->applePay = $data['applePay'] ?? null;
        $this->architecture = $data['architecture'] ?? null;
        $this->audio = $data['audio'] ?? null;
        $this->audioBaseLatency = $data['audioBaseLatency'] ?? null;
        $this->canvas = $data['canvas'] ?? null;
        $this->colorDepth = $data['colorDepth'] ?? null;
        $this->colorGamut = $data['colorGamut'] ?? null;
        $this->contrast = $data['contrast'] ?? null;
        $this->cookiesEnabled = $data['cookiesEnabled'] ?? null;
        $this->cpuClass = $data['cpuClass'] ?? null;
        $this->dateTimeLocale = $data['dateTimeLocale'] ?? null;
        $this->deviceMemory = $data['deviceMemory'] ?? null;
        $this->domBlockers = $data['domBlockers'] ?? null;
        $this->fontPreferences = $data['fontPreferences'] ?? null;
        $this->fonts = $data['fonts'] ?? null;
        $this->forcedColors = $data['forcedColors'] ?? null;
        $this->hardwareConcurrency = $data['hardwareConcurrency'] ?? null;
        $this->hdr = $data['hdr'] ?? null;
        $this->indexedDb = $data['indexedDb'] ?? null;
        $this->invertedColors = $data['invertedColors'] ?? null;
        $this->languages = $data['languages'] ?? null;
        $this->localStorage = $data['localStorage'] ?? null;
        $this->math = $data['math'] ?? null;
        $this->monochrome = $data['monochrome'] ?? null;
        $this->openDatabase = $data['openDatabase'] ?? null;
        $this->osCpu = $data['osCpu'] ?? null;
        $this->pdfViewerEnabled = $data['pdfViewerEnabled'] ?? null;
        $this->platform = $data['platform'] ?? null;
        $this->plugins = $data['plugins'] ?? null;
        $this->privateClickMeasurement = $data['privateClickMeasurement'] ?? null;
        $this->reducedMotion = $data['reducedMotion'] ?? null;
        $this->reducedTransparency = $data['reducedTransparency'] ?? null;
        $this->screenFrame = $data['screenFrame'] ?? null;
        $this->screenResolution = $data['screenResolution'] ?? null;
        $this->sessionStorage = $data['sessionStorage'] ?? null;
        $this->timezone = $data['timezone'] ?? null;
        $this->touchSupport = $data['touchSupport'] ?? null;
        $this->userAgentData = $data['userAgentData'] ?? null;
        $this->vendor = $data['vendor'] ?? null;
        $this->vendorFlavors = $data['vendorFlavors'] ?? null;
        $this->webgl = $data['webgl'] ?? null;
        $this->ip = $data['ip'] ?? null;
        $this->userAgent = $data['userAgent'] ?? null;
        $this->createdAt = $data['createdAt'] ?? time();
    }

    public function jsonSerialize(): array
    {
        return [
            'visitorId' => $this->getVisitorId(),
            'requestId' => $this->getRequestId(),
            'confidence' => $this->getConfidence(),
            'applePay' => $this->getApplePay(),
            'architecture' => $this->getArchitecture(),
            'audio' => $this->getAudio(),
            'audioBaseLatency' => $this->getAudioBaseLatency(),
            'canvas' => $this->getCanvas(),
            'colorDepth' => $this->getColorDepth(),
            'colorGamut' => $this->getColorGamut(),
            'contrast' => $this->getContrast(),
            'cookiesEnabled' => $this->getCookiesEnabled(),
            'cpuClass' => $this->getCpuClass(),
            'dateTimeLocale' => $this->getDateTimeLocale(),
            'deviceMemory' => $this->getDeviceMemory(),
            'domBlockers' => $this->getDomBlockers(),
            'fontPreferences' => $this->getFontPreferences(),
            'fonts' => $this->getFonts(),
            'forcedColors' => $this->getForcedColors(),
            'hardwareConcurrency' => $this->getHardwareConcurrency(),
            'hdr' => $this->getHdr(),
            'indexedDb' => $this->getIndexedDb(),
            'invertedColors' => $this->getInvertedColors(),
            'languages' => $this->getLanguages(),
            'localStorage' => $this->getLocalStorage(),
            'math' => $this->getMath(),
            'monochrome' => $this->getMonochrome(),
            'openDatabase' => $this->getOpenDatabase(),
            'osCpu' => $this->getOsCpu(),
            'pdfViewerEnabled' => $this->getPdfViewerEnabled(),
            'platform' => $this->getPlatform(),
            'plugins' => $this->getPlugins(),
            'privateClickMeasurement' => $this->getPrivateClickMeasurement(),
            'reducedMotion' => $this->getReducedMotion(),
            'reducedTransparency' => $this->getReducedTransparency(),
            'screenFrame' => $this->getScreenFrame(),
            'screenResolution' => $this->getScreenResolution(),
            'sessionStorage' => $this->getSessionStorage(),
            'timezone' => $this->getTimezone(),
            'touchSupport' => $this->getTouchSupport(),
            'userAgentData' => $this->getUserAgentData(),
            'vendor' => $this->getVendor(),
            'vendorFlavors' => $this->getVendorFlavors(),
            'webgl' => $this->getWebgl(),
            'ip' => $this->getIp(),
            'userAgent' => $this->getUserAgent(),
            'createdAt' => $this->getCreatedAt(),
        ];
    }

    public function getVisitorId(): ?string
    {
        return $this->visitorId;
    }

    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    public function getConfidence(): ?float
    {
        return $this->confidence;
    }

    public function getApplePay(): ?string
    {
        return $this->applePay;
    }

    public function getArchitecture(): ?string
    {
        return $this->architecture;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function getAudioBaseLatency(): ?string
    {
        return $this->audioBaseLatency;
    }

    public function getCanvas(): ?string
    {
        return $this->canvas;
    }

    public function getColorDepth(): ?int
    {
        return $this->colorDepth;
    }

    public function getColorGamut(): ?string
    {
        return $this->colorGamut;
    }

    public function getContrast(): ?string
    {
        return $this->contrast;
    }

    public function getCookiesEnabled(): ?bool
    {
        return $this->cookiesEnabled;
    }

    public function getCpuClass(): ?string
    {
        return $this->cpuClass;
    }

    public function getDateTimeLocale(): ?string
    {
        return $this->dateTimeLocale;
    }

    public function getDeviceMemory(): ?int
    {
        return $this->deviceMemory;
    }

    public function getDomBlockers(): ?array
    {
        return $this->domBlockers;
    }

    public function getFontPreferences(): ?array
    {
        return $this->fontPreferences;
    }

    public function getFonts(): ?array
    {
        return $this->fonts;
    }

    public function getForcedColors(): ?bool
    {
        return $this->forcedColors;
    }

    public function getHardwareConcurrency(): ?int
    {
        return $this->hardwareConcurrency;
    }

    public function getHdr(): ?bool
    {
        return $this->hdr;
    }

    public function getIndexedDb(): ?bool
    {
        return $this->indexedDb;
    }

    public function getInvertedColors(): ?bool
    {
        return $this->invertedColors;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function getLocalStorage(): ?bool
    {
        return $this->localStorage;
    }

    public function getMath(): ?string
    {
        return $this->math;
    }

    public function getMonochrome(): ?int
    {
        return $this->monochrome;
    }

    public function getOpenDatabase(): ?bool
    {
        return $this->openDatabase;
    }

    public function getOsCpu(): ?string
    {
        return $this->osCpu;
    }

    public function getPdfViewerEnabled(): ?bool
    {
        return $this->pdfViewerEnabled;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function getPlugins(): ?array
    {
        return $this->plugins;
    }

    public function getPrivateClickMeasurement(): ?bool
    {
        return $this->privateClickMeasurement;
    }

    public function getReducedMotion(): ?bool
    {
        return $this->reducedMotion;
    }

    public function getReducedTransparency(): ?bool
    {
        return $this->reducedTransparency;
    }

    public function getScreenFrame(): ?array
    {
        return $this->screenFrame;
    }

    public function getScreenResolution(): ?array
    {
        return $this->screenResolution;
    }

    public function getSessionStorage(): ?bool
    {
        return $this->sessionStorage;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function getTouchSupport(): ?array
    {
        return $this->touchSupport;
    }

    public function getUserAgentData(): ?array
    {
        return $this->userAgentData;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function getVendorFlavors(): ?array
    {
        return $this->vendorFlavors;
    }

    public function getWebgl(): ?string
    {
        return $this->webgl;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return $this->jsonSerialize();
    }
}
