<?php

namespace App\Controllers;

use CodeIgniter\Model;
use Error;

abstract class MainController extends BaseController
{
    /**
     * @var model of a database
     */
    protected $model;

    /**
     * @var userId
     */
    protected $userId;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->userId = session()->get('user_id');
    }

    /**
     * Show main view
     */
    abstract public function index(): void;

    /**
     * GetIndexRoute
     */
    abstract public function getIndexRoute(): string;

    /**
     * Save data to database
     */
    public function save(): \CodeIgniter\HTTP\RedirectResponse
    {
        try {
            // Call method to implement save
            $this->savePartial();

            // Send user message
            $this->sendUserNotification('success', "Registro salvo com sucesso");
        } catch (Error $error) {
            // Send user message
            $this->sendUserNotification('error', "Ocorreu um erro salvar o registro: {" . $error->getMessage() . "}");
        } catch (\ReflectionException $e) {
            // Send user message
            $this->sendUserNotification('error', "Ocorreu um erro salvar o registro (Reflection): {" . $e->getMessage() . "}");
        } finally {
            return redirect()->to($this->getIndexRoute());
        }
    }

    /**
     * Save data to database
     */
    abstract public function savePartial();

    /**
     * Delete register to database
     * @param $objectId
     */
    public function delete($objectId): void
    {
        try {
            // Call method to remove partial's objects
            $this->beforeDelete($objectId);

            // Call delete model method
            $this->model->delete($objectId);

            // Send user message
            $this->sendUserNotification('success', "Registro {$objectId} excluído com sucesso");
        } catch (Error $error) {
            // Send user message
            $this->sendUserNotification('error', "Ocorreu um erro remover o registro: { $error->getMessage() }");
        }
    }

    /**
     * Actions beforeDelete object
     * @param $objectId
     */
    public function beforeDelete($objectId): void
    {
    }

    /**
     * Send notification of a user
     * @param string $type accept types 'success, info, information, warn, warning, err, error'
     * @param string $message this is a message send to user
     */
    public function sendUserNotification(string $type, string $message): void
    {
        switch ($type) {
            case 'success':
                session()->setFlashdata('success', $message);
                break;

            case 'information':
            case 'info':
                session()->setFlashdata('info', $message);
                break;

            case 'warning':
            case 'warn':
                session()->setFlashdata('warning', $message);
                break;

            case 'error':
            case 'err':
                session()->setFlashdata('error', $message);
                break;

            default:
                throw new Error('Type {'. $type .'} not found');
        }
    }

    /**
     * Format value field to a string timestamps
     * @param \DateTime $dateTime
     * @return string
     */
    public function formatFieldTimeStamp(\DateTime $dateTime): string
    {
        if (!$dateTime) {
            return '';
        }

        return $dateTime->format('Y-m-d H:i:s');
    }
}
