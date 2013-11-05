<?php
namespace JmlSimpleAuth\Adapter;

use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Adapter\Exception;
use Zend\Authentication\Result as AuthenticationResult;

class PhpArray extends AbstractAdapter
{
    /**
     * Filename against which authentication queries are performed
     *
     * @var string
     */
    protected $filename;

    /**
     * Sets adapter options
     *
     * @param  string $filename
     * @param  string $identity
     * @param  string $credential
     */
    public function __construct($filename, $identity = null, $credential = null)
    {
        $this->setFilename($filename);
        if ($identity !== null) {
            $this->setIdentity($identity);
        }
        if ($credential !== null) {
            $this->setCredential($credential);
        }
    }

    /**
     * Returns the filename option value or null if it has not yet been set
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Sets the filename option value
     *
     * @param  string $filename
     * @return PhpArray Provides a fluent interface
     */
    public function setFilename($filename)
    {
        $this->filename = (string) $filename;
        return $this;
    }

    /**
     * Returns the username option value or null if it has not yet been set
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->getIdentity();
    }

    /**
     * Sets the username option value
     *
     * @param  mixed $username
     * @return PhpArray Provides a fluent interface
     */
    public function setUsername($username)
    {
        return $this->setIdentity($username);
    }

    /**
     * Returns the password option value or null if it has not yet been set
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->getCredential();
    }

    /**
     * Sets the password option value
     *
     * @param  mixed $password
     * @return PhpArray Provides a fluent interface
     */
    public function setPassword($password)
    {
        return $this->setCredential($password);
    }

    /**
     * Defined by Zend\Authentication\Adapter\AdapterInterface
     *
     * @throws Exception\ExceptionInterface
     * @return AuthenticationResult
     */
    public function authenticate()
    {
        $optionsRequired = array('filename', 'identity', 'credential');
        foreach ($optionsRequired as $optionRequired) {
            if (null === $this->$optionRequired) {
                throw new Exception\RuntimeException("Option '$optionRequired' must be set before authentication");
            }
        }

        if (!is_readable($this->filename)) {
            throw new Exception\RuntimeException("Users file not found");
        }
        $users = require $this->filename;

        $result = array(
            'code'  => AuthenticationResult::FAILURE,
            'identity' => $this->identity,
            'messages' => array()
        );

        if (!array_key_exists($this->identity, $users)) {
            $result['code'] = AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND;
            $result['messages'][] = "Username '$this->identity' not found";
        }
        elseif ($users[$this->identity] == $this->credential) {
            $result['code'] = AuthenticationResult::SUCCESS;
        }
        else {
            $result['code'] = AuthenticationResult::FAILURE_CREDENTIAL_INVALID;
            $result['messages'][] = 'Password incorrect';
        }

        return new AuthenticationResult($result['code'], $result['identity'], $result['messages']);
    }
}
