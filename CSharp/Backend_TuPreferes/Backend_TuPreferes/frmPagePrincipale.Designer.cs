namespace Backend_TuPreferes
{
    partial class frmPagePrincipale
    {
        /// <summary>
        /// Variable nécessaire au concepteur.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Nettoyage des ressources utilisées.
        /// </summary>
        /// <param name="disposing">true si les ressources managées doivent être supprimées ; sinon, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Code généré par le Concepteur Windows Form

        /// <summary>
        /// Méthode requise pour la prise en charge du concepteur - ne modifiez pas
        /// le contenu de cette méthode avec l'éditeur de code.
        /// </summary>
        private void InitializeComponent()
        {
            this.lsbDilemmes = new System.Windows.Forms.ListBox();
            this.label1 = new System.Windows.Forms.Label();
            this.btnAjouter = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.label3 = new System.Windows.Forms.Label();
            this.tbxRechercheDilemme = new System.Windows.Forms.TextBox();
            this.btnRechercheDilemme = new System.Windows.Forms.Button();
            this.btnResetDilemme = new System.Windows.Forms.Button();
            this.btnModifierDilemme = new System.Windows.Forms.Button();
            this.btnSupprimerDilemme = new System.Windows.Forms.Button();
            this.lsbCategorie = new System.Windows.Forms.ListBox();
            this.btnAjoutCategorie = new System.Windows.Forms.Button();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.label4 = new System.Windows.Forms.Label();
            this.tbxCategorie = new System.Windows.Forms.TextBox();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.btnModifierCategorie = new System.Windows.Forms.Button();
            this.tbxModifierCategorie = new System.Windows.Forms.TextBox();
            this.cbxCategorie = new System.Windows.Forms.ComboBox();
            this.groupBox1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.groupBox3.SuspendLayout();
            this.SuspendLayout();
            // 
            // lsbDilemmes
            // 
            this.lsbDilemmes.FormattingEnabled = true;
            this.lsbDilemmes.Location = new System.Drawing.Point(12, 50);
            this.lsbDilemmes.Name = "lsbDilemmes";
            this.lsbDilemmes.Size = new System.Drawing.Size(608, 381);
            this.lsbDilemmes.TabIndex = 0;
            this.lsbDilemmes.SelectedIndexChanged += new System.EventHandler(this.lsbDilemmes_SelectedIndexChanged);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 15.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(13, 13);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(114, 25);
            this.label1.TabIndex = 1;
            this.label1.Text = "Dilemmes";
            // 
            // btnAjouter
            // 
            this.btnAjouter.Location = new System.Drawing.Point(661, 50);
            this.btnAjouter.Name = "btnAjouter";
            this.btnAjouter.Size = new System.Drawing.Size(120, 37);
            this.btnAjouter.TabIndex = 2;
            this.btnAjouter.Text = "Ajouter un dilemme";
            this.btnAjouter.UseVisualStyleBackColor = true;
            this.btnAjouter.Click += new System.EventHandler(this.btnAjouter_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 15.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(12, 501);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(126, 25);
            this.label2.TabIndex = 3;
            this.label2.Text = "Catégories";
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.label3);
            this.groupBox1.Controls.Add(this.tbxRechercheDilemme);
            this.groupBox1.Controls.Add(this.btnRechercheDilemme);
            this.groupBox1.Location = new System.Drawing.Point(661, 111);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(329, 150);
            this.groupBox1.TabIndex = 6;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Rechercher les dilemmes d\'une categorie";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(39, 45);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(102, 13);
            this.label3.TabIndex = 8;
            this.label3.Text = "Nom de la categorie";
            // 
            // tbxRechercheDilemme
            // 
            this.tbxRechercheDilemme.Location = new System.Drawing.Point(170, 42);
            this.tbxRechercheDilemme.Name = "tbxRechercheDilemme";
            this.tbxRechercheDilemme.Size = new System.Drawing.Size(115, 20);
            this.tbxRechercheDilemme.TabIndex = 7;
            this.tbxRechercheDilemme.TextChanged += new System.EventHandler(this.tbxRechercheDilemme_TextChanged);
            // 
            // btnRechercheDilemme
            // 
            this.btnRechercheDilemme.Enabled = false;
            this.btnRechercheDilemme.Location = new System.Drawing.Point(84, 82);
            this.btnRechercheDilemme.Name = "btnRechercheDilemme";
            this.btnRechercheDilemme.Size = new System.Drawing.Size(137, 38);
            this.btnRechercheDilemme.TabIndex = 8;
            this.btnRechercheDilemme.Text = "Rechercher";
            this.btnRechercheDilemme.UseVisualStyleBackColor = true;
            this.btnRechercheDilemme.Click += new System.EventHandler(this.btnRechercheDilemme_Click);
            // 
            // btnResetDilemme
            // 
            this.btnResetDilemme.Location = new System.Drawing.Point(12, 450);
            this.btnResetDilemme.Name = "btnResetDilemme";
            this.btnResetDilemme.Size = new System.Drawing.Size(120, 32);
            this.btnResetDilemme.TabIndex = 9;
            this.btnResetDilemme.Text = "Reset la liste";
            this.btnResetDilemme.UseVisualStyleBackColor = true;
            this.btnResetDilemme.Click += new System.EventHandler(this.btnResetDilemme_Click);
            // 
            // btnModifierDilemme
            // 
            this.btnModifierDilemme.Enabled = false;
            this.btnModifierDilemme.Location = new System.Drawing.Point(661, 288);
            this.btnModifierDilemme.Name = "btnModifierDilemme";
            this.btnModifierDilemme.Size = new System.Drawing.Size(120, 37);
            this.btnModifierDilemme.TabIndex = 10;
            this.btnModifierDilemme.Text = "Modifier un dilemme";
            this.btnModifierDilemme.UseVisualStyleBackColor = true;
            this.btnModifierDilemme.Click += new System.EventHandler(this.btnModifierDilemme_Click);
            // 
            // btnSupprimerDilemme
            // 
            this.btnSupprimerDilemme.Enabled = false;
            this.btnSupprimerDilemme.Location = new System.Drawing.Point(661, 356);
            this.btnSupprimerDilemme.Name = "btnSupprimerDilemme";
            this.btnSupprimerDilemme.Size = new System.Drawing.Size(120, 37);
            this.btnSupprimerDilemme.TabIndex = 11;
            this.btnSupprimerDilemme.Text = "Supprimer un dilemme";
            this.btnSupprimerDilemme.UseVisualStyleBackColor = true;
            this.btnSupprimerDilemme.Click += new System.EventHandler(this.btnSupprimerDilemme_Click);
            // 
            // lsbCategorie
            // 
            this.lsbCategorie.FormattingEnabled = true;
            this.lsbCategorie.Location = new System.Drawing.Point(17, 547);
            this.lsbCategorie.Name = "lsbCategorie";
            this.lsbCategorie.Size = new System.Drawing.Size(456, 329);
            this.lsbCategorie.TabIndex = 12;
            this.lsbCategorie.SelectedIndexChanged += new System.EventHandler(this.lsbCategorie_SelectedIndexChanged);
            // 
            // btnAjoutCategorie
            // 
            this.btnAjoutCategorie.Location = new System.Drawing.Point(93, 87);
            this.btnAjoutCategorie.Name = "btnAjoutCategorie";
            this.btnAjoutCategorie.Size = new System.Drawing.Size(120, 37);
            this.btnAjoutCategorie.TabIndex = 13;
            this.btnAjoutCategorie.Text = "Ajouter une catégorie";
            this.btnAjoutCategorie.UseVisualStyleBackColor = true;
            this.btnAjoutCategorie.Click += new System.EventHandler(this.btnAjoutCategorie_Click);
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.label4);
            this.groupBox2.Controls.Add(this.btnAjoutCategorie);
            this.groupBox2.Controls.Add(this.tbxCategorie);
            this.groupBox2.Location = new System.Drawing.Point(568, 547);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(329, 150);
            this.groupBox2.TabIndex = 9;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Ajouter une catégorie";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(39, 45);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(102, 13);
            this.label4.TabIndex = 8;
            this.label4.Text = "Nom de la categorie";
            // 
            // tbxCategorie
            // 
            this.tbxCategorie.Location = new System.Drawing.Point(170, 42);
            this.tbxCategorie.Name = "tbxCategorie";
            this.tbxCategorie.Size = new System.Drawing.Size(115, 20);
            this.tbxCategorie.TabIndex = 7;
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.cbxCategorie);
            this.groupBox3.Controls.Add(this.btnModifierCategorie);
            this.groupBox3.Controls.Add(this.tbxModifierCategorie);
            this.groupBox3.Location = new System.Drawing.Point(568, 715);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.Size = new System.Drawing.Size(329, 150);
            this.groupBox3.TabIndex = 14;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Modifier une catégorie";
            // 
            // btnModifierCategorie
            // 
            this.btnModifierCategorie.Location = new System.Drawing.Point(93, 84);
            this.btnModifierCategorie.Name = "btnModifierCategorie";
            this.btnModifierCategorie.Size = new System.Drawing.Size(120, 37);
            this.btnModifierCategorie.TabIndex = 13;
            this.btnModifierCategorie.Text = "Modifier une catégorie";
            this.btnModifierCategorie.UseVisualStyleBackColor = true;
            this.btnModifierCategorie.Click += new System.EventHandler(this.btnModifierCategorie_Click);
            // 
            // tbxModifierCategorie
            // 
            this.tbxModifierCategorie.Location = new System.Drawing.Point(170, 42);
            this.tbxModifierCategorie.Name = "tbxModifierCategorie";
            this.tbxModifierCategorie.Size = new System.Drawing.Size(115, 20);
            this.tbxModifierCategorie.TabIndex = 7;
            // 
            // cbxCategorie
            // 
            this.cbxCategorie.FormattingEnabled = true;
            this.cbxCategorie.Location = new System.Drawing.Point(41, 41);
            this.cbxCategorie.Name = "cbxCategorie";
            this.cbxCategorie.Size = new System.Drawing.Size(121, 21);
            this.cbxCategorie.TabIndex = 14;
            this.cbxCategorie.SelectedIndexChanged += new System.EventHandler(this.cbxCategorie_SelectedIndexChanged);
            // 
            // frmPagePrincipale
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(1011, 914);
            this.Controls.Add(this.groupBox3);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.lsbCategorie);
            this.Controls.Add(this.btnSupprimerDilemme);
            this.Controls.Add(this.btnModifierDilemme);
            this.Controls.Add(this.btnResetDilemme);
            this.Controls.Add(this.groupBox1);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.btnAjouter);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.lsbDilemmes);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.Name = "frmPagePrincipale";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Accueil";
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.groupBox3.ResumeLayout(false);
            this.groupBox3.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.ListBox lsbDilemmes;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button btnAjouter;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.TextBox tbxRechercheDilemme;
        private System.Windows.Forms.Button btnRechercheDilemme;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button btnResetDilemme;
        private System.Windows.Forms.Button btnModifierDilemme;
        private System.Windows.Forms.Button btnSupprimerDilemme;
        private System.Windows.Forms.ListBox lsbCategorie;
        private System.Windows.Forms.Button btnAjoutCategorie;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox tbxCategorie;
        private System.Windows.Forms.GroupBox groupBox3;
        private System.Windows.Forms.Button btnModifierCategorie;
        private System.Windows.Forms.TextBox tbxModifierCategorie;
        private System.Windows.Forms.ComboBox cbxCategorie;
    }
}

