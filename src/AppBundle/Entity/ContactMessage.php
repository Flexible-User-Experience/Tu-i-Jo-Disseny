<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContactMessage
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   David Romaní <david@flux.cat>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactMessageRepository")
 */
class ContactMessage extends AbstractBase
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(strict = true, checkMX = true, checkHost = true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=4000)
     */
    private $message;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $checked = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $answered = false;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=4000, nullable=true)
     */
    private $answer;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set Phone
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get Message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get Checked
     *
     * @return boolean
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set Checked
     *
     * @param boolean $checked
     *
     * @return $this
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get Answered
     *
     * @return boolean
     */
    public function getAnswered()
    {
        return $this->answered;
    }

    /**
     * Set Answered
     *
     * @param boolean $answered
     *
     * @return $this
     */
    public function setAnswered($answered)
    {
        $this->answered = $answered;

        return $this;
    }

    /**
     * Get Answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set Answer
     *
     * @param string $answer
     *
     * @return $this
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->id ? $this->getCreatedAt()->format('d/m/Y') . ' · ' . $this->getEmail() : '---';
    }
}
