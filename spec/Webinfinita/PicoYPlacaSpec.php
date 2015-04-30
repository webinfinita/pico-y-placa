<?php

namespace spec\Webinfinita;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PicoYPlacaSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Webinfinita\PicoYPlaca');
    }

    function it_allows_to_drive_if_date_is_correct_and_time_is_correct()
    {
        $thursday = '2015-04-30';

        $this->check(9287, $thursday, '8:45')->shouldReturn(true);
        $this->check(9288, $thursday, '18:45')->shouldReturn(true);
    }

    function it_disallows_to_drive_if_date_is_correct_and_time_is_incorrect()
    {
        $thursday = '2015-04-30';

        $this->check(9287, $thursday, '12:45')->shouldReturn(false);
        $this->check(9288, $thursday, '20:25')->shouldReturn(false);
    }

    function it_disallows_to_drive_if_date_is_incorrect_and_time_is_correct()
    {
        $thursday = '2015-04-30';

        $this->check(9281, $thursday, '8:45')->shouldReturn(false);
        $this->check(9282, $thursday, '18:45')->shouldReturn(false);
    }

    function it_disallows_to_drive_if_date_is_incorrect_and_time_is_incorrect()
    {
        $thursday = '2015-04-30';

        $this->check(9281, $thursday, '12:45')->shouldReturn(false);
        $this->check(9282, $thursday, '20:25')->shouldReturn(false);
    }





}
