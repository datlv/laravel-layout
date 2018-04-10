<?php namespace Datlv\Layout;

use Datlv\Kit\Extensions\BackendController as BaseController;

/**
 * Class SidebarController
 *
 * @package Datlv\Layout
 */
class SidebarController extends BaseController {
    /**
     * @param string $sidebar
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $sidebar ) {
        $model = $this->getModel( $sidebar );
        $url = route( "{$this->route_prefix}backend.sidebar.update", [ 'sidebar' => $sidebar ] );

        return view( 'layout::sidebar_form', compact( 'model', 'url' ) );
    }

    /**
     * @param \Datlv\Layout\SidebarRequest $request
     * @param string $sidebar
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( SidebarRequest $request, $sidebar ) {
        $model = $this->getModel( $sidebar );
        $model->fill( $request->all() );
        $model->save();

        return view( 'kit::_modal_script', [
            'message' => [ 'type' => 'success', 'content' => trans( 'layout::sidebar.update_success' ) ],
        ] );
    }

    /**
     * @param string $sidebar
     *
     * @return string
     */
    public function collapse( $sidebar ) {
        $model = $this->getModel( $sidebar );
        $model->collapsed = 1 - $model->collapsed;
        $model->save();

        return 'OK';
    }

    /**
     * @param string $name
     *
     * @return \Datlv\Layout\Sidebar
     */
    protected function getModel( $name ) {
        return Sidebar::firstOrNew( [ 'name' => $name ] );
    }
}