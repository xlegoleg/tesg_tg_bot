<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace interfaces;


interface ICommand {
    public function getRequestData();
}