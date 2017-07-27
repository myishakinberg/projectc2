<?php
/**
 * @file
 * Contains \Drupal\custom_map\Controller\FirstController.
 */

namespace Drupal\custom_map\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {
    public function content() {
        return array(
            '#type' => 'markup',
            '#markup' => t('Hello world'),
        );
    }
}