<?php

namespace Products;

use Products\Research;

class ResearchFactory
{
    public static function createResearchFromDatabase(
        int $researchId,
        string $researchValue,
        int $nbrResearch,
        int $productId,
    ): Research {
        $research = new Research();
        $research->setResearchId($researchId);
        $research->setResearchValue($researchValue);
        $research->setNbrResearch($nbrResearch);
        $research->setProductId($productId);
        return $research;
    }
}
