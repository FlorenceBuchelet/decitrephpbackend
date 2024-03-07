<?php

namespace Products;

class Research
{
    private int $researchId;
    private string $researchValue;
    private int $nbrResearch;
    private int $productId;

    public function getResearchId(): int
    {
        return $this->researchId;
    }
    public function setResearchId(int $researchId): void
    {
        $this->researchId = $researchId;
    }
    public function getResearchValue(): string
    {
        return $this->researchValue;
    }
    public function setResearchValue(string $researchValue): void 
    {
        $this->research = $researchValue;
    }
    public function getNbrResearch(): int
    {
        return $this->nbrResearch;
    }
    public function setNbrResearch(int $nbrResearch): void
    {
        $this->nbrResearch = $nbrResearch;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }
}
