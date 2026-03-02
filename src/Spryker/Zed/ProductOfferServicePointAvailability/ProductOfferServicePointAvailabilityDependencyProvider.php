<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferServicePointAvailability;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductOfferServicePointAvailability\Dependency\Facade\ProductOfferServicePointAvailabilityToProductOfferFacadeBridge;
use Spryker\Zed\ProductOfferServicePointAvailability\Dependency\Facade\ProductOfferServicePointAvailabilityToProductOfferServicePointFacadeBridge;

class ProductOfferServicePointAvailabilityDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_OFFER_SERVICE_POINT = 'FACADE_PRODUCT_OFFER_SERVICE_POINT';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_OFFER = 'FACADE_PRODUCT_OFFER';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductOfferServicePointFacade($container);
        $container = $this->addProductOfferFacade($container);

        return $container;
    }

    protected function addProductOfferServicePointFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT_OFFER_SERVICE_POINT, function (Container $container) {
            return new ProductOfferServicePointAvailabilityToProductOfferServicePointFacadeBridge(
                $container->getLocator()->productOfferServicePoint()->facade(),
            );
        });

        return $container;
    }

    protected function addProductOfferFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT_OFFER, function (Container $container) {
            return new ProductOfferServicePointAvailabilityToProductOfferFacadeBridge(
                $container->getLocator()->productOffer()->facade(),
            );
        });

        return $container;
    }
}
