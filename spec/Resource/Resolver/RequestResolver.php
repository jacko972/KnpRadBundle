<?php

namespace spec\Knp\RadBundle\Resource\Resolver;

use PHPSpec2\ObjectBehavior;

class RequestResolver extends ObjectBehavior
{
    /**
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Knp\RadBundle\Resource\Resolver\ResourceResolver $resourceResolver
     * @param Knp\RadBundle\HttpFoundation\RequestManipulator $requestManipulator
     */
    function let($request, $requestManipulator, $resourceResolver)
    {
        $this->beConstructedWith($resourceResolver, $requestManipulator);
    }

    /**
     * @param stdObject $cheese
     */
    function it_should_resolve_request_resources($request, $requestManipulator, $resourceResolver, $cheese)
    {
        $cheeseResource = array('some', 'resource', 'options');

        $requestManipulator->hasAttribute($request, '_resources')->willReturn(true);
        $requestManipulator->getAttribute($request, '_resources')->willReturn(array('cheese' => $cheeseResource));

        $resourceResolver->resolveResource($request, $cheeseResource)->shouldBeCalled()->willReturn($cheese);

        $requestManipulator->setAttribute($request, 'cheese', $cheese)->shouldBeCalled();

        $this->resolveRequest($request);
    }
}
