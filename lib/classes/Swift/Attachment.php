<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Attachment class for attaching files to a {@link Swift_Mime_SimpleMessage}.
 *
 * @author Chris Corbyn
 */
class Swift_Attachment extends Swift_Mime_Attachment
{
    /**
     * Create a new Attachment.
     *
     * Details may be optionally provided to the constructor.
     *
     * @param string|Swift_OutputByteStream $data
     * @param string                        $filename
     * @param string                        $contentType
     */
    public function __construct($data = null, $filename = null, $contentType = null)
    {
        \call_user_func_array(
            'Swift_Mime_Attachment::__construct',
            Swift_DependencyContainer::getInstance()
                ->createDependenciesFor('mime.attachment')
            );

        $this->setBody($data, $contentType);
        $this->setFilename($filename);
    }

    /**
     * Create a new Attachment from a filesystem path.
     *
     * @param string $path
     * @param string $contentType optional
     *
     * @return self
     */
    public static function fromPath($path, $contentType = null)
    {
        return (new self())->setFile(
            new Swift_ByteStream_FileByteStream($path),
            $contentType
        );
    }
}