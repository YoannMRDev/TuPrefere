namespace Backend_TuPreferes
{
    partial class frmAjouterModifierDilemme
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.lblTitre = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.tbxChoix1 = new System.Windows.Forms.TextBox();
            this.tbxChoix2 = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.cmbCategorie = new System.Windows.Forms.ComboBox();
            this.btnAjouterModifier = new System.Windows.Forms.Button();
            this.cbxArchiver = new System.Windows.Forms.CheckBox();
            this.SuspendLayout();
            // 
            // lblTitre
            // 
            this.lblTitre.AutoSize = true;
            this.lblTitre.Font = new System.Drawing.Font("Microsoft Sans Serif", 15.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblTitre.Location = new System.Drawing.Point(299, 25);
            this.lblTitre.Name = "lblTitre";
            this.lblTitre.Size = new System.Drawing.Size(214, 25);
            this.lblTitre.TabIndex = 2;
            this.lblTitre.Text = "Ajouter un dilemme";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(40, 94);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(63, 18);
            this.label2.TabIndex = 3;
            this.label2.Text = "choix n1";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(40, 156);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(63, 18);
            this.label3.TabIndex = 4;
            this.label3.Text = "choix n2";
            // 
            // tbxChoix1
            // 
            this.tbxChoix1.Location = new System.Drawing.Point(142, 94);
            this.tbxChoix1.Multiline = true;
            this.tbxChoix1.Name = "tbxChoix1";
            this.tbxChoix1.Size = new System.Drawing.Size(599, 21);
            this.tbxChoix1.TabIndex = 5;
            this.tbxChoix1.TextChanged += new System.EventHandler(this.EnabledButtonAdd);
            // 
            // tbxChoix2
            // 
            this.tbxChoix2.Location = new System.Drawing.Point(142, 157);
            this.tbxChoix2.Multiline = true;
            this.tbxChoix2.Name = "tbxChoix2";
            this.tbxChoix2.Size = new System.Drawing.Size(599, 21);
            this.tbxChoix2.TabIndex = 6;
            this.tbxChoix2.TextChanged += new System.EventHandler(this.EnabledButtonAdd);
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(40, 215);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(84, 18);
            this.label4.TabIndex = 7;
            this.label4.Text = "Catégorie : ";
            // 
            // cmbCategorie
            // 
            this.cmbCategorie.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cmbCategorie.FormattingEnabled = true;
            this.cmbCategorie.Location = new System.Drawing.Point(142, 216);
            this.cmbCategorie.Name = "cmbCategorie";
            this.cmbCategorie.Size = new System.Drawing.Size(193, 21);
            this.cmbCategorie.TabIndex = 8;
            this.cmbCategorie.TextChanged += new System.EventHandler(this.EnabledButtonAdd);
            // 
            // btnAjouterModifier
            // 
            this.btnAjouterModifier.DialogResult = System.Windows.Forms.DialogResult.OK;
            this.btnAjouterModifier.Enabled = false;
            this.btnAjouterModifier.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btnAjouterModifier.Location = new System.Drawing.Point(43, 299);
            this.btnAjouterModifier.Name = "btnAjouterModifier";
            this.btnAjouterModifier.Size = new System.Drawing.Size(228, 44);
            this.btnAjouterModifier.TabIndex = 9;
            this.btnAjouterModifier.Text = "Ajouter un dilemme";
            this.btnAjouterModifier.UseVisualStyleBackColor = true;
            // 
            // cbxArchiver
            // 
            this.cbxArchiver.AutoSize = true;
            this.cbxArchiver.Enabled = false;
            this.cbxArchiver.Font = new System.Drawing.Font("Microsoft Sans Serif", 11.25F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.cbxArchiver.Location = new System.Drawing.Point(142, 263);
            this.cbxArchiver.Name = "cbxArchiver";
            this.cbxArchiver.Size = new System.Drawing.Size(80, 22);
            this.cbxArchiver.TabIndex = 12;
            this.cbxArchiver.Text = "Archiver";
            this.cbxArchiver.UseVisualStyleBackColor = true;
            this.cbxArchiver.Visible = false;
            // 
            // frmAjouterDilemme
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(780, 372);
            this.Controls.Add(this.cbxArchiver);
            this.Controls.Add(this.btnAjouterModifier);
            this.Controls.Add(this.cmbCategorie);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.tbxChoix2);
            this.Controls.Add(this.tbxChoix1);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.lblTitre);
            this.Name = "frmAjouterDilemme";
            this.Text = "Ajouter un dilemme";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lblTitre;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox tbxChoix1;
        private System.Windows.Forms.TextBox tbxChoix2;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.ComboBox cmbCategorie;
        private System.Windows.Forms.Button btnAjouterModifier;
        private System.Windows.Forms.CheckBox cbxArchiver;
    }
}